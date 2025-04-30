<?php

namespace App\Http\Controllers\Guru;

use Illuminate\Support\Facades\Mail;
use App\Mail\NotifikasiGuru;
use App\Models\Pesan;
use App\Models\User;
use App\Models\DataSiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PesanController extends Controller
{
    /**
     * Menampilkan halaman pesan untuk pengguna berdasarkan NIS.
     */
    public function index($nis)
    {
        // Cari siswa berdasarkan NIS
        $siswa = DataSiswa::where('nis', $nis)->firstOrFail();

        // Ambil user terkait siswa ini
        $penerima = $siswa->user;

        // Ambil semua pesan antara pengguna saat ini dan penerima
        $pesan = Pesan::where(function ($query) use ($penerima) {
            $query->where('id_pengirim', auth()->id())
                ->where('id_penerima', $penerima->id);
        })->orWhere(function ($query) use ($penerima) {
            $query->where('id_pengirim', $penerima->id)
                ->where('id_penerima', auth()->id());
        })->orderBy('waktu_kirim', 'asc')->get();

        return view('perkembangan_siswa.pesan', compact('pesan', 'siswa'));
    }

    /**
     * Menghapus pesan berdasarkan ID.
     */
    public function destroy($id_pesan)
    {
        $pesan = Pesan::findOrFail($id_pesan);

        // Pastikan pengguna hanya bisa menghapus pesan yang dikirimnya
        if ($pesan->id_pengirim != auth()->id()) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus pesan ini.');
        }

        $pesan->delete();

        return redirect()->back()->with('success', 'Pesan berhasil dihapus.');
    }

    /**
     * Mengupdate pesan berdasarkan ID.
     */
    public function update(Request $request, $id_pesan)
    {
        $request->validate([
            'pesan' => 'required|string|max:1000',
        ]);

        $pesan = Pesan::findOrFail($id_pesan);

        // Pastikan pengguna hanya bisa mengedit pesan yang dikirimnya
        if ($pesan->id_pengirim != auth()->id()) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit pesan ini.');
        }

        $pesan->update([
            'pesan' => $request->pesan,
        ]);

        return redirect()->back()->with('success', 'Pesan berhasil diperbarui.');
    }

    /**
     * Menyimpan pesan yang dikirim oleh user berdasarkan NIS.
     */
    public function store(Request $request, $nis)
    {
        $request->validate([
            'pesan' => 'required|string|max:1000',
        ]);

        // Cari siswa berdasarkan NIS
        $siswa = DataSiswa::where('nis', $nis)->firstOrFail();

        // Ambil user terkait siswa ini
        $penerima = $siswa->user;

        // Validasi role
        $pengirim = auth()->user();
        if (($pengirim->role === 'guru' && $penerima->role !== 'ortu') || ($pengirim->role === 'ortu' && $penerima->role !== 'guru')) {
            abort(403, 'Anda tidak dapat mengirim pesan ke user ini.');
        }

        // Simpan pesan
        $pesan = Pesan::create([
            'id_pengirim' => $pengirim->id,
            'id_penerima' => $penerima->id,
            'pesan' => $request->pesan,
            'waktu_kirim' => now(),
        ]);

        // Kirim email notifikasi
        Mail::to($penerima->email)->send(new NotifikasiGuru($pengirim, $pesan));

        return redirect()->route('pesan.index', $nis)->with('success', 'Pesan berhasil dikirim.');
    }
}


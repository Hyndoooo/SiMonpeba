<?php

namespace App\Http\Controllers\Ortu;

use App\Mail\NotifikasiOrtu;
use Illuminate\Support\Facades\Mail;
use App\Models\DataSiswa;
use App\Models\Guru;
use App\Models\Pesan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PesanOrtuController extends Controller
{
    /**
     * Menampilkan halaman pesan untuk guru dan orang tua.
     */
    public function index(Request $request)
    {
        $user = auth()->user(); // Mendapatkan user yang sedang login
        
        // Ambil data siswa
        $siswa = DataSiswa::find($user->siswa_id); // Misalnya siswa dihubungkan dengan user
        
        // Ambil daftar guru
        $gurus = Guru::all(); // Mengambil semua data guru

        // Mengambil data siswa berdasarkan user yang login
        $siswa = DataSiswa::where('id', $user->id)->firstOrFail();

        // Jika ada id_penerima yang dipilih
        $id_penerima = $request->input('id_penerima', null);
        
        // Ambil riwayat pesan yang terkait dengan guru yang dipilih dan user
        if ($id_penerima) {
            $pesanDikirim = Pesan::where('id_pengirim', $user->id)->where('id_penerima', $id_penerima)->get();
            $pesanDiterima = Pesan::where('id_penerima', $user->id)->where('id_pengirim', $id_penerima)->get();
        } else {
            // Jika tidak ada guru yang dipilih, tampilkan pesan umum
            $pesanDikirim = collect();
            $pesanDiterima = collect();
        }

        // Kirim data ke view
        return view('ortu.pesan', compact('siswa', 'gurus', 'pesanDikirim', 'pesanDiterima', 'id_penerima'));
    }

    public function destroy($id_pesan)
    {
        $pesan = Pesan::where('id_pesan', $id_pesan)
                    ->where('id_pengirim', auth()->id())
                    ->first();

        if ($pesan) {
            $pesan->delete();
            return redirect()->back()->with('success', 'Pesan berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Pesan tidak ditemukan atau Anda tidak memiliki izin.');
    }

    public function update(Request $request, $id_pesan)
    {
        $request->validate([
            'pesan' => 'required|string|max:1000',
        ]);

        $pesan = Pesan::where('id_pesan', $id_pesan)
                    ->where('id_pengirim', auth()->id())
                    ->firstOrFail();

        $pesan->update([
            'pesan' => $request->pesan,
        ]);

        return redirect()->back()->with('success', 'Pesan berhasil diperbarui.');
    }

    /**
     * Menyimpan pesan yang dikirim oleh user.
     */
    public function store(Request $request, $id_penerima)
    {
        // Validasi input
        $validated = $request->validate([
            'pesan' => 'required|string|max:1000',
        ]);

        // Validasi apakah penerima ada
        $penerima = User::findOrFail($id_penerima);

        // Simpan pesan ke database
        $pesan = Pesan::create([
            'id_pengirim' => auth()->id(),
            'id_penerima' => $penerima->id,
            'pesan' => $validated['pesan'],
            'waktu_kirim' => now(),
        ]);

        // Kirim notifikasi email
        Mail::to($penerima->email)->send(new NotifikasiOrtu(auth()->user(), $pesan));

        return redirect()->route('ortu.pesan.index')->with('success', 'Pesan berhasil dikirim!');
    }
}

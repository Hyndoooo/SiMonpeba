<?php

namespace App\Http\Controllers\Guru;

use App\Models\PerkembanganSiswa;
use Illuminate\Http\Request;
use App\Models\DataSiswa;
use App\Models\User;
use App\Mail\PerkembanganSiswaNotification;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class DetailPerkembanganSiswaController extends Controller
{
    public function index($nis)
    {
        // Cari data siswa berdasarkan NIS
        $siswa = DataSiswa::where('nis', $nis)->firstOrFail();

        // Kirim data ke view
        return view('perkembangan_siswa.detail', compact('siswa'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'nis' => 'required|exists:data_siswa,nis',
            'jadwal_pelajaran' => 'required|string',
            'penjelasan_perkembangan' => 'required|string',
            'catatan' => 'nullable|string',
            'bukti_media' => 'nullable|file|mimes:jpg,png,jpeg,mp4|max:30720', // Validasi untuk file media
            'waktu' => 'required|date',
        ]);

        // Ambil data siswa berdasarkan NIS
        $siswa = DataSiswa::where('nis', $validated['nis'])->first();
        if (!$siswa) {
            return back()->with('error', 'Data siswa tidak ditemukan.');
        }

        // Tambahkan nama siswa ke data yang akan disimpan
        $validated['nama'] = $siswa->nama;

        // Simpan file media jika ada
        if ($request->hasFile('bukti_media')) {
            // Menyimpan file bukti media ke folder 'bukti_media' dalam storage
            $validated['bukti_media'] = $request->file('bukti_media')->store('uploads/bukti_media', 'public');
        }

        // Simpan data ke tabel perkembangan_siswa
        PerkembanganSiswa::create($validated);

        $orangTua = User::where('role', 'ortu')
            ->whereHas('dataSiswa', function ($query) use ($siswa) {
                $query->where('id', $siswa->id);
            })->first();

        if (!$orangTua) {
            return back()->with('error', 'Orang tua dari siswa ini tidak ditemukan.');
        }

        // Kirim email notifikasi
        $emailData = [
            'nama' => $siswa->nama,
            'nis' => $siswa->nis,
            'jadwal_pelajaran' => $validated['jadwal_pelajaran'],
            'penjelasan_perkembangan' => $validated['penjelasan_perkembangan'],
            'catatan' => $validated['catatan'],
        ];

        Mail::to($orangTua->email)->send(new PerkembanganSiswaNotification($emailData));

        // Redirect dengan pesan sukses
        return redirect()->route('perkembangan_siswa.detail', ['nis' => $validated['nis']])
            ->with('success', 'Perkembangan siswa berhasil disimpan.');
    }
}
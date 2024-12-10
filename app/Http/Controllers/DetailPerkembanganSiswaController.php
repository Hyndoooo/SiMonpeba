<?php

namespace App\Http\Controllers;

use App\Models\PerkembanganSiswa;
use Illuminate\Http\Request;
use App\Models\DataSiswa;

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
            'bukti_media' => 'nullable|file|mimes:jpg,png,jpeg|max:2048', // Validasi untuk file media
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
            $validated['bukti_media'] = $request->file('bukti_media')->store('bukti_media', 'public');
        }

        // Simpan data ke tabel perkembangan_siswa
        PerkembanganSiswa::create($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('perkembangan_siswa.detail', ['nis' => $validated['nis']])
            ->with('success', 'Perkembangan siswa berhasil disimpan.');
    }
}

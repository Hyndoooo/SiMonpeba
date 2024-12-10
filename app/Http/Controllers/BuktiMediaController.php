<?php

namespace App\Http\Controllers;

use App\Models\PerkembanganSiswa;
use Illuminate\Http\Request;

class BuktiMediaController extends Controller
{
    // Menampilkan bukti media
    public function show($nis)
    {
        // Cari data perkembangan siswa berdasarkan NIS
        $perkembangan = PerkembanganSiswa::where('nis', $nis)->firstOrFail();
        $siswa = $perkembangan->dataSiswa; // Asumsi hubungan telah didefinisikan

        // Kirim data ke view bukti media
        return view('ortu.bukti_media', compact('perkembangan', 'siswa'));
    }

    // Mengunduh bukti media
    public function download($nis)
    {
        // Cari data perkembangan siswa berdasarkan NIS
        $perkembangan = PerkembanganSiswa::where('nis', $nis)->firstOrFail();

        // Mengambil file bukti media
        $file = storage_path('app/public/' . $perkembangan->bukti_media);

        // Jika file tidak ada
        if (!file_exists($file)) {
            return redirect()->back()->with('error', 'File bukti media tidak ditemukan.');
        }

        // Download file
        return response()->download($file);
    }
}

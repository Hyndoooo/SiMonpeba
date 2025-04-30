<?php

namespace App\Http\Controllers\Ortu;

use App\Models\PerkembanganSiswa;
use App\Http\Controllers\Controller;

class BuktiMediaController extends Controller
{
    // Menampilkan bukti media
    public function show($nis)
    {
        try {
            // Cari data perkembangan siswa berdasarkan NIS
            $perkembangan = PerkembanganSiswa::where('nis', $nis)->firstOrFail();

            // Periksa apakah ada bukti media
            if (!$perkembangan->bukti_media) {
                throw new \Exception('Bukti media tidak tersedia untuk siswa ini.');
            }

            // Kirim data ke view untuk ditampilkan
            return view('ortu.bukti_media', [
                'perkembangan' => $perkembangan,
                'siswa' => $perkembangan->dataSiswa,
            ]);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Mengunduh bukti media
    public function download($nis)
    {
        try {
            // Cari data perkembangan siswa berdasarkan NIS
            $perkembangan = PerkembanganSiswa::where('nis', $nis)->firstOrFail();

            // Ambil path file bukti media
            $file = storage_path('app/public/' . $perkembangan->bukti_media);

            // Jika file tidak ada
            if (!file_exists($file)) {
                throw new \Exception('File bukti media tidak ditemukan.');
            }

            // Download file
            return response()->download($file);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

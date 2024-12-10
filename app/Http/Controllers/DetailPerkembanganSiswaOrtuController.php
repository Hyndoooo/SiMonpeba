<?php

namespace App\Http\Controllers;

use App\Models\PerkembanganSiswa;
use App\Models\DataSiswa;

class DetailPerkembanganSiswaOrtuController extends Controller
{
    /**
     * Menampilkan detail perkembangan siswa berdasarkan NIS.
     *
     * @param string $nis
     * @return \Illuminate\View\View
     */
    public function index($nis)
    {
        // Cari data siswa berdasarkan NIS
        $siswa = DataSiswa::where('nis', $nis)->firstOrFail();

        // Cari perkembangan siswa yang terbaru berdasarkan NIS
        $perkembangan = PerkembanganSiswa::where('nis', $nis)->latest()->first(); // Ambil yang terbaru

        // Kirim data siswa dan perkembangan ke view
        return view('ortu.detail', compact('siswa', 'perkembangan'));
    }
}

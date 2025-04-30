<?php

namespace App\Http\Controllers\Ortu;

use App\Models\PerkembanganSiswa;
use App\Models\DataSiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoriOrtuController extends Controller
{
    /**
     * Menampilkan histori perkembangan siswa berdasarkan NIS.
     *
     * @param  string $nis
     * @return \Illuminate\View\View
     */
    public function index($nis)
    {
        // Pastikan NIS valid (opsional)
        if (!is_numeric($nis)) {
            abort(404, 'Data siswa tidak valid.');
        }

        // Cari data siswa berdasarkan NIS, atau gagal jika tidak ditemukan
        $siswa = DataSiswa::where('nis', $nis)->firstOrFail();

        // Ambil data histori perkembangan siswa berdasarkan NIS
        $histori = PerkembanganSiswa::where('nis', $nis)
            ->orderBy('waktu', 'desc')
            ->get();

        // Kirim data ke view
        return view('ortu.histori', compact('siswa', 'histori'));
    }
}

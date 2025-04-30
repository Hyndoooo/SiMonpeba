<?php

namespace App\Http\Controllers\Ortu;

use Illuminate\Http\Request;
use App\Models\PerkembanganSiswa;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class DownloadControllerOrtu extends Controller
{
    public function downloadPDF($nis)
    {
        // Ambil data histori berdasarkan NIS
        $histori = PerkembanganSiswa::where('nis', $nis)->orderBy('waktu', 'desc')->get();

        // Jika data tidak ditemukan
        if ($histori->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada histori untuk NIS ini.');
        }

        // Kirim data ke view PDF
        $pdf = Pdf::loadView('ortu.download', compact('histori'));

        // Unduh file PDF
        return $pdf->download("Histori_Perkembangan_NIS_{$nis}.pdf");
    }
}


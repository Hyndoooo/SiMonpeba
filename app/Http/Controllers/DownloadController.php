<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerkembanganSiswa; // Pastikan model sesuai
use Barryvdh\DomPDF\Facade\Pdf;

class DownloadController extends Controller
{
    public function downloadPDF($nis)
    {
        // Ambil data histori berdasarkan NIS
        $histori = PerkembanganSiswa::where('nis', $nis)->get();

        // Jika data tidak ditemukan
        if ($histori->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada histori untuk NIS ini.');
        }

        // Kirim data ke view PDF
        $pdf = Pdf::loadView('perkembangan_siswa.download', compact('histori'));

        // Unduh file PDF
        return $pdf->download("Histori_Perkembangan_NIS_{$nis}.pdf");
    }
}

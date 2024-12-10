<?php

namespace App\Http\Controllers;

use App\Models\PerkembanganSiswa;
use Illuminate\Http\Request;
use App\Models\DataSiswa;
use Illuminate\Support\Facades\Storage;

class HistoriController extends Controller
{
    public function index($nis)
    {
        // Cari data siswa berdasarkan NIS
        $siswa = DataSiswa::where('nis', $nis)->firstOrFail();

        // Ambil data histori perkembangan siswa berdasarkan NIS
        $histori = PerkembanganSiswa::where('nis', $nis)
            ->orderBy('waktu', 'desc')
            ->get();

        // Kirim data ke view
        return view('perkembangan_siswa.histori', compact('siswa', 'histori'));
    }

    public function destroy($id)
    {
        // Cari data berdasarkan id
        $perkembangan = PerkembanganSiswa::findOrFail($id);

        // Hapus file bukti_media jika ada
        if ($perkembangan->bukti_media) {
            Storage::disk('public')->delete($perkembangan->bukti_media);
        }

        // Hapus data dari database
        $perkembangan->delete();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data perkembangan berhasil dihapus.');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataSiswa; // Import model DataSiswa

class PerkembanganSiswaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kata kunci dari input pencarian
        $search = $request->input('search');

        // Jika ada pencarian, filter berdasarkan nama siswa
        if ($search) {
            $dataSiswa = DataSiswa::where('nama', 'like', '%' . $search . '%')->paginate(8);
        } else {
            // Jika tidak ada pencarian, ambil semua data siswa dengan pagination
            $dataSiswa = DataSiswa::paginate(8);
        }

        // Kirim data siswa ke view
        return view('perkembangan_siswa.guru', compact('dataSiswa', 'search'));
    }
}
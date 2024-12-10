<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesanController extends Controller
{
    /**
     * Menampilkan halaman pesan untuk guru dan orang tua.
     */
    public function index()
    {
        // Mengambil pesan yang dikirim dan diterima oleh user yang sedang login
        $user = auth()->user();
        $pesanDikirim = $user->pesanDikirim;  // Pesan yang dikirim oleh user
        $pesanDiterima = $user->pesanDiterima;  // Pesan yang diterima oleh user

        return view('perkembangan_siswa.pesan', compact('pesanDikirim', 'pesanDiterima'));
    }

    /**
     * Menampilkan form untuk mengirim pesan.
     */
    public function create($id_penerima)
    {
        // Mengambil data penerima berdasarkan ID
        $penerima = User::findOrFail($id_penerima);

        // Menampilkan form pengiriman pesan dengan data penerima
        return view('perkembangan_siswa.create_pesan', compact('penerima'));
    }

    /**
     * Menyimpan pesan yang dikirim oleh user.
     */
    public function store(Request $request, $id_penerima)
    {
        // Validasi input pesan
        $validated = $request->validate([
            'pesan' => 'required|string|max:1000',  // Pastikan pesan tidak kosong dan memiliki panjang maksimal
        ]);

        // Mendapatkan user yang sedang login
        $user = auth()->user();

        // Membuat pesan baru
        $pesan = new Pesan();
        $pesan->id_pengirim = $user->id;
        $pesan->id_penerima = $id_penerima;
        $pesan->pesan = $request->pesan;
        $pesan->waktu_kirim = now();

        // Menyimpan pesan ke database
        $pesan->save();

        // Redirect kembali ke halaman pesan dengan pesan sukses
        return redirect()->route('pesan.index')->with('success', 'Pesan berhasil dikirim!');
    }
}

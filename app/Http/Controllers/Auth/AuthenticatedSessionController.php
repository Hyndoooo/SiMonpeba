<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
{
    // Validasi permintaan
    $request->validate([
        'username' => ['required', 'string'],
        'password' => ['required', 'string', 'min:8'],
    ]);

    // Mencari user berdasarkan username
    $user = \App\Models\User::where('username', $request->username)->first();

    // Memeriksa apakah user ditemukan
    if (!$user) {
        return back()->withErrors(['username' => 'Username tidak ditemukan.'])->onlyInput('username');
    }

    // Memeriksa apakah password sesuai
    if (!Hash::check($request->password, $user->password)) {
        return back()->withErrors(['password' => 'Password yang diberikan salah.'])->onlyInput('password');
    }

    // Login user
    Auth::login($user);

    // Periksa role user dan redirect sesuai role
    if ($user->role === 'guru') {
        return redirect()->route('guru.dashboard');
    } 

    if ($user->role === 'ortu') {
        return redirect()->route('ortu.dashboard');
    }

    // Pengalihan default jika role tidak dikenali
    return redirect('/');
}




    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (auth()->check()) {
            $user = auth()->user();

            // Cek role yang diberikan
            if ($role === 'guru' && $user->role === 'guru') {
                return $next($request);
            }

            if ($role === 'ortu' && $user->role === 'ortu') {
                return $next($request);
            }
        }

        // Jika role tidak cocok, kembalikan ke halaman login atau halaman lain
        return redirect('/login');
    }
}


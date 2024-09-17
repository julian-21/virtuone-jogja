<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ResetCsrfToken
{
    public function handle($request, Closure $next)
    {
        // Cek apakah sesi pengguna masih aktif
        if (Session::has('user')) {
            // Reset token CSRF
            $request->session()->regenerateToken();
        }

        return $next($request);
    }
}

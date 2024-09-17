<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ResetDailyLimit
{
    public function handle(Request $request, Closure $next)
    {
        // Tentukan kunci cache harian
        $today = now()->format('Y-m-d');
        $dailyLimitKey = 'daily_limit_' . $today;

        // Cek apakah batas harian sudah tercapai
        $dailyLimit = Cache::get($dailyLimitKey, 0);

        if ($dailyLimit >= 3) {
            return redirect()->route('formulir.create')->withErrors(['jam' => 'Anda telah mencapai batas pengisian untuk hari ini.']);
        }

        // Lanjutkan ke langkah berikutnya jika belum mencapai batas harian
        return $next($request);
    }
}

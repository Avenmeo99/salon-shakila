<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Hanya izinkan user yang sudah login & is_admin = true.
     * Jika tidak memenuhi, balas 403 (Forbidden).
     */
    public function handle(Request $request, Closure $next)
    {
        // Belum login?
        if (!$request->user()) {
            // paksa login dulu
            return redirect()->route('login');
        }

        // Sudah login tapi bukan admin?
        if (!$request->user()->is_admin) {
            abort(403, 'Hanya admin.');
        }

        // Lolos: lanjut ke request berikutnya
        return $next($request);
    }
}

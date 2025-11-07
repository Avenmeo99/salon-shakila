<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Pastikan user sudah login dan punya flag is_admin = true
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Hanya admin yang bisa mengakses halaman ini.');
        }

        return $next($request);
    }
}

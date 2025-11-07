<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Jika user sudah login, arahkan ke HOME
     */
    public function handle(Request $request, Closure $next, string ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Jika konstanta HOME ada, gunakan itu. Kalau tidak, pakai route('home')
                return redirect()->intended(RouteServiceProvider::HOME ?? route('home'));
            }
        }

        return $next($request);
    }
}

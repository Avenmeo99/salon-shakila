<?php
class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!$request->user() || !$request->user()->is_admin) {
            abort(403,'Hanya admin.');
        }
        return $next($request);
    }
}

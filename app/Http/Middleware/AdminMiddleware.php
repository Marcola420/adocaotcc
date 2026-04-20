<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle($request, Closure $next)
{
    if (!auth()->check() || auth()->user()->is_admin != 1) {
        return redirect('/')->with('error', 'Acesso negado');
    }

    return $next($request);
}
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
 public function handle($request, Closure $next)
{
    // logger('Current User:', [Auth::user()]);
    
    // if (!Auth::check() || Auth::user()->role !== 'admin') {
    //     abort(403, 'Akses ditolak. Anda bukan admin.');
    // }

    // return $next($request);
}
}

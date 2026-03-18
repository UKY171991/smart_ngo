<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsMember
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && (auth()->user()->role === 'member' || auth()->user()->role === 'staff' || auth()->user()->role === 'admin')) {
            return $next($request);
        }

        return redirect('/login')->with('error', 'Please login to access your member dashboard.');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && (auth()->user()->role === 'admin' || (auth()->user()->role_relation && auth()->user()->role_relation->slug === 'admin'))) {
            return $next($request);
        }

        return redirect()->route('admin.login')->with('error', 'Unauthorized access.');
    }
}

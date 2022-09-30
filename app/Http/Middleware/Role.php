<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->role == 1) {
            return $next($request);
        }

        else if(auth()->user()->role == 0) {
            return $next($request);
        }

        else if(auth()->user()->role == 2) {
            return $next($request);
        }

        else if(auth()->user()->role == 3) {
            return $next($request);
        }

        else if(auth()->user()->role == 4) {
            return $next($request);
        }

        else if(auth()->user()->role == 5) {
            return $next($request);
        }

        else if(auth()->user()->role == 6) {
            return $next($request);
        }




    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->tipo == 1) {
            return $next($request);
        } else if (auth()->user()->tipo == 2) {
            return redirect('/home');
        } else if(auth()->user()->tipo == 3) {
            return redirect('/home');
        } else if(auth()->user()->tipo == 4) {
            return redirect('/home');
        }
    }
}

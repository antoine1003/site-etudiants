<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->hasRole(['prof','eleve','parent'])) {
                return redirect()->route('user.dashboard');
            }
            else
            {
                return redirect()->route('user.welcome' , ['id' => 1]);
            }
            
        }

        return $next($request);
    }
}

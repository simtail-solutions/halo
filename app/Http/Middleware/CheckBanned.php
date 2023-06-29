<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && (auth()->user()->activated == 0)){
            \Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', 'Your Account have been deactivated, please contact Pretty Penny Finance for reactivation.');

            }

        return $next($request);
    }
}

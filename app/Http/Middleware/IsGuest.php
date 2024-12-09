<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() == FALSE) {
            return $next($request);
        } else {
            if(Auth::user()->role =='Admin') {
                return redirect()->route('dashboard')->with('failed', 'Anda sudah login! Tidak dapat melakukan pemrosesan login kembali !');
            }else{
                return redirect()->route('home')->with('failed', 'Anda sudah login! Tidak dapat melakukan pemrosesan login kembali !');
            }
        }
    }
}

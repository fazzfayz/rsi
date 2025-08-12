<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek jika user sudah login
        if (Auth::check()) {
            // Cek jika session sudah expired
            if (Session::has('last_activity')) {
                $lastActivity = Session::get('last_activity');
                $timeout = config('session.lifetime') * 60; // Convert ke detik
                
                if (time() - $lastActivity > $timeout) {
                    // Session expired, logout user
                    Auth::logout();
                    Session::flush();
                    
                    // Redirect ke login dengan pesan
                    return redirect()->route('login')->with('error', 'Sesi Anda telah berakhir. Silakan login kembali.');
                }
            }
            
            // Update last activity
            Session::put('last_activity', time());
        }

        return $next($request);
    }
}

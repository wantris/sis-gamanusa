<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Student;
use Illuminate\Support\Facades\Session;

class SiswaMiddleware
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
        if (Session::get('is_student') == "0"  && Session::get('is_student') == "0") {
            return redirect()->route('siswa.auth.login')->with('failed', 'Anda harus login');
        } elseif (Session::get('is_student') == "1"  && Session::get('is_student') == "0") {
            return redirect()->route('siswa.auth.login')->with('failed', 'Anda bukan siswa');
        }

        return $next($request);
    }
}

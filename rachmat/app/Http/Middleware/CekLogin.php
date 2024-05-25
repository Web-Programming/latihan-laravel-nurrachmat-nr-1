<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        //cek jika user sudah login. jika belum arahkan ke hal. login
        if(!Auth::check()){
            return redirect('login');
        }

        //simpan data user pada var user
        $user = Auth::user();
        //jika level user sama dengan role, request dapat dilanjutkan
        if($user->level === $roles){
            return $next($request);
        }
        //jika user tidak memiliki akses sesuai dengan role
        return redirect('login')->with('error', 'Maaf anda tidak memiliki akses!');
    }
}

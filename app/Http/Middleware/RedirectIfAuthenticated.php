<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|*Bertugas untuk mencegah pengguna yang sudah login mengakses halaman tertentu
|
*
*
 */
class RedirectIfAuthenticated
{
    /**
     * Menangani permintaan yang masuk
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        /*Jika tidak ada guard yang diberikan, gunakan guard yang default*/
        $guards = empty($guards) ? [null] : $guards;

        /*Iterari setiap guard yang diberikan */
        foreach ($guards as $guard) {
            /*Periksa apakah pengguna sudah login menggunakan guard tertentu */
            if (Auth::guard($guard)->check()) {
                /*Jika pengguna sudah login, arahkan pengguna ke halaman dashboard */
                return redirect(RouteServiceProvider::HOME);
            }
        }

         // Jika pengguna belum login, lanjutkan ke middleware berikutnya atau proses permintaan
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        /*Memeriksa apakah peran pengguna saat ini ada dalam daftar peran yang diizinkan */
        if(in_array($request->user()->roles,$roles)) {
            /*Jika peran cocok, lanjutkan ke request berikutnya */
            return $next($request);
        }
        /*Jika tidak, kembali ke halaman sebelumnya */
        return redirect()->back();
    }
}

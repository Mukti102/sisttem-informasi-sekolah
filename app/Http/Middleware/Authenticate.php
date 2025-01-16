<?php

namespace App\Http\Middleware;
/*
|Fungsi untuk memastikan bahwa hanya pengguna yang terautentikasi yang dapat mengakses 
*
*
*/
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Mendapatkan path yang harus diarahkan pengguna ketika tidak terautentikasi.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        /*Memeriksa apakah permintaan tidak mengharapkan respons JSON*/
        if (! $request->expectsJson()) {
            /*Mengembalikan rute untuk halaman login jika tidak mengharapkan JSON */
            return route('login');
        }
    }
}

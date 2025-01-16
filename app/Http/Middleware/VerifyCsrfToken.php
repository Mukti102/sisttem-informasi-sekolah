<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Daftar URI yang harus dikecualikan dari verifikasi CSRF.
     *
     * @var array<int, string>
     */

    /*Variabel ini menyimpan daftar URI yang tidak memerlukan verifikasi CSRF */
    protected $except = [
        //
    ];
}


/*Fungsi ini digunakan untuk mengatur kecualian dari verifikasi CSRF */
/*CSRF (Cross-Site Request Forgery merupakan jenis serangan keamanan yang memanfaatkan kepercayaan yang dimiliki oleh aplika web
   terhadap pengguna yang terautentifikasi)  */
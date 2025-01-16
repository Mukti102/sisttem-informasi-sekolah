<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini bertanggung jawab untuk menangani verifikasi email bagi
    | pengguna yang baru saja mendaftar di aplikasi. Email juga dapat
    | dikirim ulang jika pengguna tidak menerima pesan email yang asli.
    |
    */

    use VerifiesEmails;

    /**
     * i mana untuk mengarahkan pengguna setelah verifikasi.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Membuat instance controller baru.
     * @return void
     */
    /*Konstruktor untuk mengatur middleware yang digunakan pada controller ini */
    public function __construct()
    {
        /*Menggunakan auth untuk memastikan pengguna terautentikasi */
        $this->middleware('auth');
        /*Menggunakan middleware untuk memastikan pengguna telah mengirimkan email */
        $this->middleware('signed')->only('verify');
        /*Menggunakan throttle untuk membatasi permintaan verifikasi email */
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}

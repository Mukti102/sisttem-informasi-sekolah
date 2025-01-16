<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Tumpukan middleware yang akan dijalankan oleh program.
     *
     * Middleware ini dijalankan selama setiap permintaan ke program/web anda.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,                                  //Middleware untuk mempercayai host tertentu
        \App\Http\Middleware\TrustProxies::class,                                   //Middleware untuk mempercayai proxy yang digunakan
        \Fruitcake\Cors\HandleCors::class,                                          //Middleware untuk menangani permintaan CORS
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,               //Mencegah permintaan saat aplikasi dalam mode pemeliharaan
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,             //Memvalidasi ukuran permintaan POST   
        \App\Http\Middleware\TrimStrings::class,                                    //Memangkas spalsi di awal dan akhir string input
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,    //Mengubah string kosong menjadi null
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            /*Kelompok middleware yang akan dijalankan saat permintaan ke program web*/
            \App\Http\Middleware\EncryptCookies::class,                                 //Mengenkripsi cookie
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,            //Menambahkan cookie yang telah diantri ke respons
            \Illuminate\Session\Middleware\StartSession::class,                         //Memulai sesi
            // \Illuminate\Session\Middleware\AuthenticateSession::class,               //Mengautentikasi sesi
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,                  //Membagikan kesalahan dari sesi ke tampilan
            \App\Http\Middleware\VerifyCsrfToken::class,                                //Memverifikasi token CSRF
            \Illuminate\Routing\Middleware\SubstituteBindings::class,                   //Menggantikan binding rute
        ],

        'api' => [
            /*Kelompok middleware untuk rute API */
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api', //Mengatur batas permintaan API
            \Illuminate\Routing\Middleware\SubstituteBindings::class, /*Middleware untuk menggantikan binding rute */
        ],
    ];

    /**
     * Middleware rute aplikasi.
     *
     * Middleware ini ditugaskan ke kelompok atau digunakan secara individu.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,                                 //Mengautentukasi pengguna
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,       //Mengatur header chace
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,              //Mengizinkan akses berdasarkan kebijakan
        'can' => \Illuminate\Auth\Middleware\Authorize::class,                              //Mengalihkan pengguna yang sudah terautentikasi
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,                     //Meminta konfirmasi password
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,           //Memvalidasi tandatangan user
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,               //Membatasi jumlah permintaan
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,               //Memastikan email telah diverifikasi
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,             //Memeriksa peran pengguna
        'checkRole' => \App\Http\Middleware\CheckRole::class,
    ];
}

/*File ini berfungsi untuk mengatur middleware yang akan dijalankan pada web*/
<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

/**
 * Kelas EncryptCookies digunakan untuk mengenkripsi atau mendekripsi cookie aplikasi.
 * Middleware ini memastikan bahwa data sensitif dalam cookie tidak disimpan dalam teks biasa
 * sehingga lebih aman dari ancaman seperti penyadapan data.
 */

class EncryptCookies extends Middleware
{
    /**
     * Daftar nama cookie yang dikecualikan dari proses enkripsi.
     *
     * 
     * Jika ada cookie yang tidak perlu dienkripsi, tambahkan namanya ke dalam array ini.
     * Misalnya, cookie yang digunakan oleh pihak ketiga yang sudah terenkripsi sebelumnya.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}

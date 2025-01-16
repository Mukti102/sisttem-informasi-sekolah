<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/***
 * Bagian laravel yang berfungsi untuk penyedia layanan 
 * Service Provider ( tempat penyediaan layanan )
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Mendaftarkan layanan aplikasi.
     *
     * @return void
     */
    /*Mendaftarkan layanan ke container */
    public function register()
    {
        //
    }

    /**
     * Melakukan bootstrap pada layanan boostrap.
     *
     * @return void
     */
   
    public function boot()
    {
        //
    }
}

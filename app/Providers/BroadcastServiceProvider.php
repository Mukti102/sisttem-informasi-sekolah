<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

/***
 * Mengatur dan memfasilitasi broadcasting dalam aplikasi laravel.
 * Menyederhanakan proses pengiriman data dari server ke klien yang memerlukan interaksi real-time.
 */
class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*Mendaftarkan rute untuk broadcaasting */
        Broadcast::routes();

        /*Memuat file channels.php yang berisi definisi saluran siaran */
        require base_path('routes/channels.php');
    }
}

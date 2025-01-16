<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

/***
 * Fungsi untuk mengatur rute API dan rute web
 * Membatasi konfigurasi untuk membatasi jumlah permintaan (rate limiting)
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * Jalur ke rute "home" untuk web.
     *
     * Digunakan untuk mengatur rute untuk mengarahkan user ke halaman dashboard setelah login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Ruang nama controller untuk web.
     *
     * Ketika ada deklarasi rute controller akan secara otomatis diawali dengan ruang nama ini.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Mendefinisikan pengikatan model rute, filter pola, dll.
     *
     * @return void
     */
    public function boot()
    {
        /*Mengonfigurasi pembatasan jumlah permintaan untuk web */
        $this->configureRateLimiting();

        /*Mendefenisikan rute untuk web */
        $this->routes(function () {
            /*Mengelompokkan rute API dengan prefix 'api' */
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            /*Mengelompokan rute web dengan middleware 'web' */
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Konfigurasai rate limiter untuk aplikasi.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        /*Mengatur batasan jumlah permintaan ke rute API */
        RateLimiter::for('api', function (Request $request) {

            /*Mengizinkan 60 permintaan per menit per pengguna atau berdasarkan IP */
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}

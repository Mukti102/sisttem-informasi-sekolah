<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

/***
 * Pengatur otentikasi dan otorisasi. Dengan kebijakan akses dan gate.
 * Memperbolehkan pengembang untuk mengelola izin pengguna berdasarkan peran
 */

/*Mengatur otentikasi dan otoritas */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * Pemetaan kebijakan untuk model dalam web.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy', //hanya contoh untuk tidak lupa
    ];

    /**
     * Mendaftarkan layanan otentikasi dan otorisasi.
     *
     * Metode ini dipanggil saat aplikasi booting
     * @return void
     */
    public function boot()
    {
        /*Mendaftarkan kebijakan yang telah didefenisikan di $policies */
        $this->registerPolicies();

        /*Mendefenisikan gate untuk memeriksa apakah pengguna memiliki peran 'admin' */
        Gate::define('admin', function (User $user) {
            return $user->roles == 'admin';
        });

        /*Mendefenisikan gate untuk memeriksa apakah pengguna memiliki peran 'guru' */
        Gate::define('guru', function (User $user) {
            return $user->roles == 'guru';
        });
    }
}

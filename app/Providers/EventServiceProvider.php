<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

/***
 * Fungsi untuk penghubung antara event dan listener
 * listener : kelas yang mendengarkan event tertentu dan melakukan tindakan event tersebut.
 * File ini mengatur dan menghubungkan event pendaftaran pengguna dengan listener yang akan mengirimkan email verifikasi.
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * Pemetaan listener event untuk aplikasi.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        /*Ketika event Registered terjadi, maka akan dipanggil listener SendEmailVerificationNotification*/
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Mendaftar event apapun untuk aweb.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

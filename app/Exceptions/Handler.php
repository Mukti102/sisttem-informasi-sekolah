<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Daftar jenis pengecualian yang tidak dilaporkan
     *Daftar ini berisi pengecualian-pengecualian yang tidak perlu dilaporkan ke dalam log aplikasi.
     * Jika ada pengecualian yang ada di dalam array ini, pengecualian tersebut akan diabaikan dan tidak dicatat.
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * Daftar input yang tidak pernah diproses untuk pengecualian validasi.
     *
     * Daftar ini berisi input yang tidak akan dibawa saat terjadi pengecualian validasi.
     * Biasanya, data sensitif seperti password yang tidak ingin terlihat dalam log.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}

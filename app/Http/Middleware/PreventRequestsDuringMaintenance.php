<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

/**
 * Kelas PreventRequestsDuringMaintenance adalah middleware yang bertugas untuk
 * mengatur akses selama aplikasi berada dalam mode pemeliharaan (maintenance mode).
 * Middleware ini mencegah permintaan (request) ke aplikasi kecuali untuk URI tertentu
 * yang ditentukan dalam properti `except`.
 */

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * Daftar URI (endpoint) yang tetap dapat diakses saat aplikasi dalam mode pemeliharaan.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}

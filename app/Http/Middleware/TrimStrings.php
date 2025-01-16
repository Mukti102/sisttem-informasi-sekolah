<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

/*
|*Fungsi untuk menghapus spasi pada inputan user
|
|
|
| */
class TrimStrings extends Middleware
{
    /**
     * Nama - nama atribut yang tidak boleh dipangkas.
     *
     * @var array<int, string>
     */

     /*Mendeklarasikan array yang berisi atribut yang tidak boleh dipangkas*/
    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
    ];
}

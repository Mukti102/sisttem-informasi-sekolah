<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * Daftar proxy yang dipercaya untuk aplikasi ini.
     *
     * @var array<int, string>|string|null
     */

     /*Variabel ini menyimpan daftar proxy yang dipercaya oleh web*/
    protected $proxies;

    /**
     * Header yang harus digunakan untuk mendeteksi proxy.
     *
     * @var int
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |       //Header untuk alamat IP pengunjung
        Request::HEADER_X_FORWARDED_HOST |      //Header untuk host asli
        Request::HEADER_X_FORWARDED_PORT |      //Header untuk port asli
        Request::HEADER_X_FORWARDED_PROTO |     //Header untuk protokol asli
        Request::HEADER_X_FORWARDED_AWS_ELB;    //Header untuk mendeteksi load balancer AWS
}


/*Proxy merupakan layanan yang bertindak sebagai perantara antara pengguna(klien) dan server tujuan */

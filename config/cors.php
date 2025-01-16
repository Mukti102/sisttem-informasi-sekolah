<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat mengonfigurasi pengaturan untuk berbagi sumber daya lintas asal
    | atau "CORS". Ini menentukan operasi lintas asal apa yang dapat dieksekusi
    | di browser web. Anda bebas menyesuaikan pengaturan ini sesuai kebutuhan.
    |
    | Untuk menghubungkan web dengan API
    |
    |
    |
    */

    /*Menentukan jalur yang diizinkan untuk permintaan lintas */
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    /*Menentukan metode HTTP yang diizinkan,, Metode HTTP (GET,POST,PUT,DELETE,dll) */
    'allowed_methods' => ['*'],

    /*Menentukan domain yang diizinkan untuk permintaan lintas */
    'allowed_origins' => ['*'],

    /*Menentukan pola domain yang diizinkan */
    'allowed_origins_patterns' => [],

    /**
     * Header : informasi tambahan
     * Menentukan header yang r=diizinkan
     */
    'allowed_headers' => ['*'],

    /*Menentukan header yang diekspos pada respons */
    'exposed_headers' => [],

    /*Menentukan durasi */
    'max_age' => 0,

    /*tidak membutuhkan otentikasi cookies atau header */
    'supports_credentials' => false,

];

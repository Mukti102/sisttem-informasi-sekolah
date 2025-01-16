<?php

use Illuminate\Support\Str;

/***
 * Mengatur sistem chache dalam aplikasi laravel
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Default Cache Store
    |--------------------------------------------------------------------------
    |
    | This option controls the default cache connection that gets used while
    | using this caching library. This connection is used when another is
    | not explicitly specified when executing a given caching function.
    |
    */

    /*Menentukan driver cache yang digunakan*/
    'default' => env('CACHE_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Cache Stores
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the cache "stores" for your application as
    | well as their drivers. You may even define multiple stores for the
    | same cache driver to group types of items stored in your caches.
    |
    | Supported drivers: "apc", "array", "database", "file",
    |         "memcached", "redis", "dynamodb", "octane", "null"
    |
    */

    'stores' => [

        /*Menentukan driver untuk chace APC ( alternative PHP cache ) 
        *APC digunakan untuk meningkatkan performa aplikasi.
        *Fungsi untuk menyimpan proses yang berulang agar kinerja web baik
        *contoh : data absensi, pertemuan dll
        */
        'apc' => [
            'driver' => 'apc',
        ],

        /*Menetukan driver untuk chace Array */
        /**
         * Penyimpanan data dalam siklus permintaan (cth : permintaan membuka dashboard)
         */
        'array' => [
            'driver' => 'array',
            'serialize' => false, //menentukan apakah data harus di serialize atau tidak
        ],

        /*Menetukan driver untuk chace Database*/
        /***
         * untuk menjaga penyimpanan data, meskipun server mati
         * data chace tetap ada walaupun website di restart
         */
        'database' => [
            'driver' => 'database',
            'table' => 'cache', 
            'connection' => null,
            'lock_connection' => null,
        ],

        /*Menetukan driver untuk chace file */
        /**
         * File akan disimpan di drive lokal server
         * 
         */
        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
        ],

        /*memchaced merupakan chacing berbasis memori yang digunkan untuk meningkatkan performa web */
        /**
         * Digunakan agar performa web baik walaupun banyak yang akses, dan web selalu sering membutuhkan data yang sama seperti pertemuan, materi
         * 
         * 
         */
        'memcached' => [
            'driver' => 'memcached',
            'persistent_id' => env('MEMCACHED_PERSISTENT_ID'),
            'sasl' => [
                env('MEMCACHED_USERNAME'),
                env('MEMCACHED_PASSWORD'),
            ],
            'options' => [
                // Memcached::OPT_CONNECT_TIMEOUT => 2000,
            ],
            'servers' => [
                [
                    'host' => env('MEMCACHED_HOST', '127.0.0.1'),
                    'port' => env('MEMCACHED_PORT', 11211),
                    'weight' => 100,
                ],
            ],
        ],

        /*Konesksi yang digunakan untuk redis */
        /**
         * Menyimpan data atau status yang dapat berkaitan meskipun sistem dimatikan
         * 
         * 
         */ 
        'redis' => [
            'driver' => 'redis',
            'connection' => 'cache',
            'lock_connection' => 'default',
        ],

        /*Koneksi untuk dynamodb , karena web merupakan skala besar dan membutuhkan chache yang andal dan terdistribusi*/
        'dynamodb' => [
            'driver' => 'dynamodb',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'table' => env('DYNAMODB_CACHE_TABLE', 'cache'),
            'endpoint' => env('DYNAMODB_ENDPOINT'),
        ],

        /*agar dapat menggunakan cache di laravel */
        'octane' => [
            'driver' => 'octane',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Key Prefix
    |--------------------------------------------------------------------------
    |
    | When utilizing a RAM based store such as APC or Memcached, there might
    | be other applications utilizing the same cache. So, we'll specify a
    | value to get prefixed to all our keys so we can avoid collisions.
    |
    */

    /*Menentukan prefix,  mencegah konflik kunci cache jika beberapa aplikasi menggunakan driver cache yang sama */
    'prefix' => env('CACHE_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_cache'),

];

<?php

use Illuminate\Support\Str;

/**
 * Pengelolaan database yang memberikan fleksibilitas dan kemudahan \
 * Mengatur koneksi database yang digunakan
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Menentukan koneksi databaese mana yang akan digunakan sebagai default
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    |Mengkonfigurasi koneksi database yang akan digunakan
    */

    'connections' => [

        /*Konfigurasi untuk koneksi SQLite */
        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        /*Konfigurasi untuk koneksi MySQL */
        'mysql' => [
            'driver' => 'mysql', //nama driver
            'url' => env('DATABASE_URL'),   //Mengambil URL database dari environment variable DATABASE_URL jika tersedia
            'host' => env('DB_HOST', '127.0.0.1'), //localhost
            'port' => env('DB_PORT', '3306'),   //port
            'database' => env('DB_DATABASE', 'forge'), //nama database yang digunakan, forge (default)
            'username' => env('DB_USERNAME', 'forge'), //nama pengguna untuk mengakses database
            'password' => env('DB_PASSWORD', ''),      //password mengakses database
            'unix_socket' => env('DB_SOCKET', ''),     //koneksi lokal tanpa IP
            'charset' => 'utf8mb4',                     //mendukung karakter unicode 
            'collation' => 'utf8mb4_unicode_ci',    //Menentukan charset
            'prefix' => '',   //tabel prefix
            'prefix_indexes' => true, //menentukan menggunakn prefix tabel
            'strict' => true, //mengaktifkan mode ketat
            'engine' => null, //menggunakn innoDB
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        /*pgsql = PostgreSQL => sebagai sistem manajemen basis data */
        'pgsql' => [
            'driver' => 'pgsql', //nama driver
            'url' => env('DATABASE_URL'),  //agar dapat mengakses database dari environment variable DATABASE_URL
            'host' => env('DB_HOST', '127.0.0.1'), //alamat localhost
            'port' => env('DB_PORT', '5432'),   //port
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8', //menggunakan charset utf8 mendukung multibahasa
            'prefix' => '',
            'prefix_indexes' => true, //menggunakan prefix tabel
            'schema' => 'public', //membuat tabel yang sama namun dengan fungsi yang berbeda
            'sslmode' => 'prefer', //menggunakan SSL yang tersedia
        ],

        /*SQL Server, menghubungkan dengan database SQL Server*/
        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'localhost'), //mengambil nilai variabel dari file .env
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    |
    |Fungsi untuk mengelola schema database
    |Fungsi membantu menjaga keteraturan dalam pengelolaaa database (alat pengembangan laravel)
    */

    'redis' => [

        /*Menentukan client, default */
        'client' => env('REDIS_CLIENT', 'phpredis'),

        
        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'), //cluster default, untuk membantu mencegah satu node dari kelebihan beban
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'), //menambahkan prefix pada setiap key disimpan di redis
        ],

        'default' => [
            /*Mengatur URL redis */
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        /*Mengatur URL Redis untuk chace  */
        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

    ],

];

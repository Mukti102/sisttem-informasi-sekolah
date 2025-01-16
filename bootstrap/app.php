<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Langkah pertama adalah membuat instance baru dari aplikasi Laravel.
| Instance ini berfungsi sebagai "perekat" untuk semua komponen Laravel
| dan juga sebagai kontainer IoC (Inversion of Control) yang mengikat
| semua bagian sistem.
|
*/

/*Membuat instance aplikasi laravel dengan menentukan path dasar dari web */
$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Selanjutnya, kita perlu mengikat beberapa antarmuka penting ke dalam
| kontainer agar kita dapat menyelesaikannya saat dibutuhkan. Kernel
| akan melayani permintaan yang masuk ke aplikasi ini baik dari web
| maupun CLI (Command Line Interface)
|
*/

/*Mengikat antarmuka HTTP Kernel ke implementasi App\Http\Kernel  */
$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

/*Mengikat antarmuka Command Kernel ke implementasi App\Console\Kernel */
$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*Mengikat antarmuka Exception Handler ke implementasi App\Exceptions\Handler */
$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| Skrip ini mengembalikan instance aplikasi. Instance ini diberikan
| kepada skrip pemanggil sehingga kita dapat memisahkan pembuatan
| instance dari eksekusi aplikasi dan pengiriman respons
|
*/

return $app;

<?php
/*
|komponen kunci dalam pengembangan aplikasi Laravel yang membantu 
|dalam pengelolaan permintaan dan respons dengan cara yang terstruktur dan efisien.
*/
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/*Mendefenisikan controller untuk menangani request dan response dari user*/
class Controller extends BaseController
{
    /*Menggunakan trait untuk mengakses fitur-fitur yang sudah ada di Laravel*/
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

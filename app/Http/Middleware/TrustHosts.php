<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TrustHosts extends Middleware
{
    /**
     * Mendapatkan pola host yang harus dipercaya.
     *
     * @return array<int, string|null>
     */
    public function hosts()
    {
        /*
        |*Mengembalikan array yang berisi pola host yang harus dipercaya.
        |*Dalam hal ini, semua subdomain dari URL aplikasi akan dianggap sebagai host yang diizinkan untuk berinteraksi dengan web.
        |
        |
        | */
        return [
            $this->allSubdomainsOfApplicationUrl(),
        ];
    }
}

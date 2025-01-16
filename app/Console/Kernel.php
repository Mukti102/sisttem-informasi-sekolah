<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Mendefenisikan jadwal perintah program
     *
     * Digunakan untuk menjadwalkan perintah artisan atau tugas lain yang perlu dijalankan secara berkala
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Mendaftarkan perintah untuk program.
     *
     * Digunakan untuk mendaftarkan semua perintah artisan kustom yang dibuat
     * @return void
     */
    protected function commands()
    {
        /*Ini akan mendaftarkan perintah-perintah kustom yang ada di folder app/Console/Commands*/
        $this->load(__DIR__.'/Commands');

         // Perintah tambahan ini bisa didefinisikan di file routes/console.php*/
        require base_path('routes/console.php');
    }
}

/**file ini berguna untuk mengatur jadwal dan perintah console yang akan dijalankan secara otomatis */

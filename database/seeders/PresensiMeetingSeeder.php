<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PresensiMeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('presensi_meetings')->insert([
            'siswa_id' => 1,
            'meeting_id' => 1,
            'status' => 'hadir',
        ]);
    }
}

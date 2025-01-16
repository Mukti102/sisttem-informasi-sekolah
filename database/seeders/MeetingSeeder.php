<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meetings')->insert([
            'id' => (string) Str::uuid(), // Generate UUID
            'absensi_id' => 1,
            'pertemuan_ke' => '1',
        ]);
    }
}

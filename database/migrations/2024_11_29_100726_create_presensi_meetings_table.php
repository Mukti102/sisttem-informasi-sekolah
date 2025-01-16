<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresensiMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensi_meetings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meeting_id'); // Tambahkan meeting_id baru
            $table->foreign('meeting_id')->references('id')->on('meetings')->onDelete('cascade'); // Foreign key baru
            $table->unsignedBigInteger('siswa_id'); // Tambahkan siswa_id baru
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade'); // Foreign key baru
            $table->enum('status', ['hadir', 'alpha', 'sakit', 'izin', 'telat', '-'])->default('-');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presensi_meetings', function (Blueprint $table) {
            $table->dropForeign(['meeting_id']); // Menambahkan array untuk menghapus foreign key
            $table->dropColumn('meeting_id'); // Menghapus kolom meeting_id jika diperlukan
        });
    }
}

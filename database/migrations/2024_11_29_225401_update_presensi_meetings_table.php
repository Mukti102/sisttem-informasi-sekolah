<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePresensiMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presensi_meetings', function (Blueprint $table) {
            $table->dropForeign(['meeting_id']); // Hapus foreign key lama
            $table->dropColumn('meeting_id');    // Hapus kolom meeting_id lama
        });

        Schema::table('presensi_meetings', function (Blueprint $table) {
            $table->unsignedBigInteger('meeting_id'); // Tambahkan meeting_id baru
            $table->foreign('meeting_id')->references('id')->on('meetings')->onDelete('cascade'); // Foreign key baru
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
            $table->dropForeign(['meeting_id']);
            $table->dropColumn('meeting_id');
        });

        Schema::table('presensi_meetings', function (Blueprint $table) {
            $table->uuid('meeting_id'); // Kembali ke UUID
            $table->foreign('meeting_id')->references('id')->on('meetings')->onDelete('cascade');
        });
    }
}

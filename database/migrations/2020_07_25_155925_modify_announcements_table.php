<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->renameColumn('id_kegiatan', 'id_announcement');
            $table->renameColumn('nama_kegiatan', 'judul');
            $table->renameColumn('tanggal_kegiatan', 'tgl_announcement');
            $table->renameColumn('deskripsi', 'isi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

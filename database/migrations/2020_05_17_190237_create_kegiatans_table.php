<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->bigIncrements('id_kegiatan');
            $table->string('nama_kegiatan');
            $table->date('tanggal_kegiatan');
            $table->text('deskripsi');
            $table->unsignedBigInteger('id_masjid');//referensi dari masjid
            $table->unsignedBigInteger('id_pengurus'); //referensi dari pengurus_masjid
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
        Schema::dropIfExists('kegiatans');
    }
}

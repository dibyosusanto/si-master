<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas__keluars', function (Blueprint $table) {
            $table->bigIncrements('id_pengeluaran');
            $table->date('tgl_pengeluaran');
            $table->integer('nominal');
            $table->string('keterangan');
            $table->unsignedBigInteger('id_masjid');//referensi dari masjid
            $table->unsignedBigInteger('id_pengurus'); //referensi dari pengurus
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
        Schema::dropIfExists('kas__keluars');
    }
}

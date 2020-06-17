<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfaqMasjidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infaq__masjids', function (Blueprint $table) {
            $table->bigIncrements('id_infaq');
            $table->date('tgl_infaq');
            $table->string('keterangan')->nullable();
            $table->integer('nominal');
            $table->unsignedBigInteger('id_jamaah');//referensi dari jamaah_masjid
            $table->foreign('id_jamaah')->references('id_jamaah')->on('jamaah__masjids')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_masjid'); //referensi dari masjid
            $table->foreign('id_masjid')->references('id_masjid')->on('masjids')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_pengurus'); //referensi dari pengurus
            $table->foreign('id_pengurus')->nullable()->references('id_pengurus')->on('penguruses')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('infaq__masjids');
    }
}

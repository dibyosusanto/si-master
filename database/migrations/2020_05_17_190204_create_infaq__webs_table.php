<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfaqWebsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infaq__webs', function (Blueprint $table) {
            $table->bigIncrements('id_infaq');
            $table->date('tgl_infaq');
            $table->string('keterangan')->nullable();
            $table->string('bukti_infaq');
            $table->integer('nominal');
            $table->boolean('status_validasi')->default(false); //true jika sudah divalidasi, false jika belum
            $table->unsignedBigInteger('id_jamaah');//referensi dari jamaah_web
            $table->unsignedBigInteger('id_masjid'); //referensi dari masjid
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
        Schema::dropIfExists('infaq__webs');
    }
}

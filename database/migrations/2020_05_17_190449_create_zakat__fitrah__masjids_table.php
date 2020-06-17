<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZakatFitrahMasjidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zakat__fitrah__masjids', function (Blueprint $table) {
            $table->bigIncrements('id_zakat');
            $table->date('tgl_zakat');
            $table->string('keterangan')->nullable();
            $table->integer('nominal');
            $table->unsignedBigInteger('id_jamaah');//referensi dari jamaah_masjid
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
        Schema::dropIfExists('zakat__fitrah__masjids');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMuzakkiMasjidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muzakki__masjids', function (Blueprint $table) {
            $table->bigIncrements('id_muzakki');
            $table->unsignedBigInteger('id_zakat');//referensi dari zakat_fitrah_masjid
            $table->foreign('id_zakat')->references('id_zakat')->on('zakat__fitrah__masjids')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_muzakki', 50);
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
        Schema::dropIfExists('muzakki__masjids');
    }
}

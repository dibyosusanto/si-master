<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMuzakkiWebsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muzakki__webs', function (Blueprint $table) {
            $table->bigIncrements('id_muzakki');
            $table->unsignedBigInteger('id_zakat');//referensi dari zakat_fitrah_web
            $table->foreign('id_zakat')->references('id_zakat')->on('zakat__fitrah__webs')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('muzakki__webs');
    }
}

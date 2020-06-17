<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJamaahMasjidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jamaah__masjids', function (Blueprint $table) {
            $table->bigIncrements('id_jamaah');
            $table->string('nama_jamaah');
            $table->string('alamat');
            $table->date('tgl_lahir');
            $table->string('no_hp')->unique();
            $table->string('jenis_kelamin');
            $table->unsignedBigInteger('id_masjid');//referensi dari masjid
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
        Schema::dropIfExists('jamaah__masjids');
    }
}

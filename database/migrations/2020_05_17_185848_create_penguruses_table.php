<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengurusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penguruses', function (Blueprint $table) {
            $table->bigIncrements('id_pengurus');
            $table->string('nama_pengurus');
            $table->string('no_hp')->unique();
            $table->string('alamat');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->unsignedBigInteger('id_masjid'); //merujuk pada tabel masjid
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
        Schema::dropIfExists('penguruses');
    }
}

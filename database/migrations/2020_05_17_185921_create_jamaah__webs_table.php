<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJamaahWebsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jamaah__webs', function (Blueprint $table) {
            $table->bigIncrements('id_jamaah');
            $table->string('nama_jamaah');
            $table->string('alamat');
            $table->date('tgl_lahir');
            $table->string('no_hp')->unique();
            $table->string('jenis_kelamin');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
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
        Schema::dropIfExists('jamaah__webs');
    }
}

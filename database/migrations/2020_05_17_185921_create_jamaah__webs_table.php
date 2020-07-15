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
            $table->string('nama_jamaah', 50);
            $table->string('alamat');
            $table->date('tgl_lahir');
            $table->string('no_hp', 13)->unique();
            $table->string('jenis_kelamin', 1);
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')
                    ->onUpdate('cascade')->onDelete('cascade');
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

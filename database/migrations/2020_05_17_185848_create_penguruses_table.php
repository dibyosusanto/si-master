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
            $table->string('nama_pengurus', 50);
            $table->string('no_hp', 13)->unique();
            $table->string('alamat');
            $table->unsignedBigInteger('id_masjid'); //merujuk pada tabel masjid
            $table->foreign('id_masjid')->references('id_masjid')->on('masjids')
                    ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_user'); //merujuk pada tabel users
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
        Schema::dropIfExists('penguruses');
    }
}

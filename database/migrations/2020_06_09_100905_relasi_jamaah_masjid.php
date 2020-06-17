<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelasiJamaahMasjid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Menambahkan foreign key pada tabel pengurus
        Schema::table('jamaah__masjids', function(Blueprint $table){
            $table->foreign('id_masjid')->references('id_masjid')->on('masjids')
                    ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jamaah__masjids', function(Blueprint $table){
            $table->dropForeign('jamaah__masjids_id_masjid_foreign');
        });

        Schema::table('jamaah__masjids', function(Blueprint $table){
            $table->dropIndex('jamaah__masjids_id_masjid_foreign');
        });
    }
}

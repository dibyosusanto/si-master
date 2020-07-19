<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyZakatFitrahMasjids extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zakat__fitrah__masjids', function(Blueprint $table){
            $table->renameColumn('nominal', 'banyaknya');
            $table->tinyInteger('jenis')->after('tgl_zakat');
            //1 untuk beras, 2 untuk uang
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('zakat__fitrah__masjids', function(Blueprint $table){
            $table->dropColumn('jenis');
            //1 untuk beras, 2 untuk uang
        });
    }
}

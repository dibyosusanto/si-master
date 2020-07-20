<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJmlMuzakki extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zakat__fitrah__masjids', function(Blueprint $table){
            $table->tinyInteger('jml_muzakki')->after('keterangan');
        });

        Schema::table('zakat__fitrah__webs', function(Blueprint $table){
            $table->tinyInteger('jml_muzakki')->after('keterangan');
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
            $table->dropColumn('jml_muzakki');
        });
        
        Schema::table('zakat__fitrah__webs', function(Blueprint $table){
            $table->dropColumn('jml_muzakki');
        });
    }
}

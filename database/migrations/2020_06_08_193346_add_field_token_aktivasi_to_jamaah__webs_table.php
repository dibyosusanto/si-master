<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldTokenAktivasiToJamaahWebsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jamaah__webs', function (Blueprint $table) {
            $table->string('token_aktivasi')->after('password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jamaah__webs', function (Blueprint $table) {
            $table->dropColumn('token_aktivasi');
        });
    }
}

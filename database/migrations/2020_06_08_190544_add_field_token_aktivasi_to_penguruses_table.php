<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldTokenAktivasiToPengurusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penguruses', function (Blueprint $table) {
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
        Schema::table('penguruses', function (Blueprint $table) {
            $table->dropColumn('token_aktivasi');
        });
    }
}

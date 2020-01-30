<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdPenjualToJbcarts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jbcarts', function (Blueprint $table) {
            $table->unsignedBigInteger('id_penjual');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jbcarts', function (Blueprint $table) {
        
            $table->dropColumn('id_penjual');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteForeginKeyInAuctionProcesses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auction_processes', function (Blueprint $table) {
            // $table->dropForeign(['id_penawar']);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auction_processes', function (Blueprint $table) {
            // $table->foreign('id_penawar')
            //         ->references('id')
            //         ->on('users')
            //         ->onDelete('cascade');
        });
    }
}

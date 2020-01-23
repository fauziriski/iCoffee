<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeginKeyToAuctionProcess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auction_processes', function (Blueprint $table) {

            // $table->foreign('id_produk')
            //         ->references('id')
            //         ->on('auction_products')
            //         ->onDelete('cascade');

            // $table->foreign('id_pelelang')
            //         ->references('id')
            //         ->on('users')
            //         ->onDelete('cascade');
        
            // $table->foreign('id_penawar')
            //         ->references('id')
            //         ->on('users')
            //         ->onDelete('cascade');
            
            
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
            // $table->dropForeign(['id_produk']);
            // $table->dropForeign(['id_pelelang']);
            // $table->dropForeign(['id_penawar']);
        });
    }
}

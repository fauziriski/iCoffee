<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_processes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_produk');
            $table->unsignedBigInteger('id_pelelang');
            $table->unsignedBigInteger('id_penawar');
            $table->integer('penawaran');
            $table->integer('pemenang');
            $table->integer('kelipatan');
            $table->integer('status');
            $table->timestamps();

            
            $table->foreign('id_produk')
                    ->references('id')
                    ->on('auction_products')
                    ->onDelete('cascade');

            $table->foreign('id_pelelang')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auction_processes');
    }
}

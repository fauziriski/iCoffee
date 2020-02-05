<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionWinnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_winners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pemenang');
            $table->unsignedBigInteger('id_pelelang');
            $table->unsignedBigInteger('id_produk_lelang');
            $table->bigInteger('jumlah_penawaran');
            $table->timestamps();


            $table->foreign('id_pemenang')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('id_pelelang')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('id_produk_lelang')
                    ->references('id')
                    ->on('auction_products')
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
        Schema::dropIfExists('auction_winners');
    }
}

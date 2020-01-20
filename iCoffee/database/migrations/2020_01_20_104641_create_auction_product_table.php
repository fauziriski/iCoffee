<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pelelang');
            $table->string('nama_produk', 100);
            $table->string('desc_produk', 255);
            $table->integer('kelipatan');
            $table->integer('harga_awal');
            $table->integer('lama_lelang');
            $table->string('gambar');
            $table->string('kode_lelang');
            $table->integer('status');
            $table->timestamps();


            $table->foreign('id_pelelang')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

        });

        Schema::create('auction_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pelelang');
            $table->unsignedBigInteger('id_produk');
            $table->string('nama_gambar');
            $table->timestamps();

            $table->foreign('id_pelelang')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('id_produk')
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
        Schema::dropIfExists('auction_products');
        Schema::dropIfExists('auction_images');
    }
}

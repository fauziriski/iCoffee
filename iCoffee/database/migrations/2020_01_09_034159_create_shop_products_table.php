<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kategori');
            $table->timestamps();
        });

        Schema::create('shop_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_kategori');
            $table->string('nama_produk');
            $table->string('detail_produk');
            $table->string('gambar');
            $table->integer('harga');
            $table->integer('stok');
            $table->timestamps();

            $table->foreign('id_pelanggan')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('id_kategori')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });


        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_produk');
            $table->string('nama_gambar');
            $table->timestamps();

            $table->foreign('id_pelanggan')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('id_produk')
                ->references('id')
                ->on('shop_products')
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
        Schema::drop('categories');
        Schema::drop('shop_products');
        Schema::drop('images');
    }
}

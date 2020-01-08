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


        Schema::create('category_shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_category');
            $table->timestamps();
        });


        Schema::create('shop_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pengguna');
            $table->unsignedBigInteger('id_kategori');
            $table->string('nama_produk');
            $table->integer('stok');
            $table->integer('harga');
            $table->string('gambar');
            $table->timestamps();


            $table->foreign('id_kategori')->references('id')->on('category_shops');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_products');
    }
}

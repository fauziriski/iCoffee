<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invest_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_kelompok_tani');
            $table->unsignedBigInteger('id_kategori');
            $table->string('nama_produk');
            $table->string('detail_produk');
            $table->string('gambar');
            $table->integer('harga');
            $table->integer('stok');
            $table->integer('bunga');
            $table->integer('periode');
            $table->integer('profit_periode');
            $table->timestamps();

            // $table->foreign('id_kategori')
            //     ->references('id')
            //     ->on('categories')
            //     ->onDelete('cascade');
            // $table->foreign('id_kelompok_tani')
            //     ->references('id')
            //     ->on('kelompok_tani')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('invest_product');
    }
}

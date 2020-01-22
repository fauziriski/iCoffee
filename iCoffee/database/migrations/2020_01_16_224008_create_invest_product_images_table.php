<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invest_product_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_mitra');
            $table->unsignedBigInteger('id_produk');
            $table->string('nama');
            $table->timestamps();

            $table->foreign('id_produk')
                ->references('id')
                ->on('invest_product')
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
        Schema::dropIfExists('invest_product_images');
    }
}

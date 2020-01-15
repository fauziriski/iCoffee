<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('nama');
            $table->string('provinsi');
            $table->string('kota/kabupaten');
            $table->string('kecamatan');
            $table->integer('kode_pos');
            $table->string('address', 255);
            $table->integer('no_hp');
            $table->timestamps();

            $table->foreign('id_pelanggan')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });



        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_alamat');
            $table->string('nama');
            $table->string('invoice');
            $table->integer('status');
            $table->string('payment');
            $table->string('shipping');
            $table->timestamps();

            $table->foreign('id_pelanggan')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('id_alamat')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        

        Schema::create('orderdetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_penjual');
            $table->unsignedBigInteger('id_order');
            $table->unsignedBigInteger('id_produk');
            $table->string('nama_produk');
            $table->string('invoice');
            $table->integer('jumlah');
            $table->integer('harga');
            $table->integer('total');
            $table->timestamps();

            $table->foreign('id_pelanggan')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('id_penjual')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('id_order')
                ->references('id')
                ->on('orders')
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
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('order');
        Schema::dropIfExists('orderdetails');
        
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_penjual');
            $table->unsignedBigInteger('id_pembeli');
            $table->unsignedBigInteger('id_alamat_penjual');
            $table->unsignedBigInteger('id_alamat_pembeli');
            $table->string('nama');
            $table->string('invoice');
            $table->string('payment');
            $table->string('shipping');
            $table->string('pesan')->nullable();
            $table->integer('sub_total');
            $table->integer('total_bayar');
            $table->integer('status');
            $table->timestamps();


            $table->foreign('id_penjual')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('id_pembeli')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('id_alamat_penjual')
                    ->references('id')
                    ->on('addresses')
                    ->onDelete('cascade');

            $table->foreign('id_alamat_pembeli')
                    ->references('id')
                    ->on('addresses')
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
        Schema::dropIfExists('auction_orders');
    }
}

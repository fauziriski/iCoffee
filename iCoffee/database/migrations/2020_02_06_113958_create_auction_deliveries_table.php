<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_deliveries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_order');
            $table->unsignedBigInteger('id_kategori_kurir');            
            $table->string('nama');
            $table->bigInteger('ongkos_kirim');
            $table->text('invoice')->nullable();
            $table->timestamps();

            $table->foreign('id_order')
                    ->references('id')
                    ->on('auction_orders')
                    ->onDelete('cascade');

            $table->foreign('id_kategori_kurir')
                    ->references('id')
                    ->on('delivery_categories')
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
        Schema::dropIfExists('auction_deliveries');
    }
}

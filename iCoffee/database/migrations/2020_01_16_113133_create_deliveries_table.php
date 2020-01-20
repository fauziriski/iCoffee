<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_pengiriman');
            $table->timestamps();

        });

        Schema::create('deliveries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pengiriman');
            $table->string('asal');
            $table->string('tujuan');
            $table->integer('ongkos_kirim');

            $table->timestamps();


            $table->foreign('id_pengiriman')
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
        Schema::dropIfExists('deliveries');
    }
}

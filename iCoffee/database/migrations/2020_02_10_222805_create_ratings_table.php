<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_penjual');
            $table->unsignedBigInteger('id_pembeli');
            $table->unsignedBigInteger('id_order');
            $table->string('invoice');
            $table->integer('rating');
            $table->timestamps();

            $table->foreign('id_penjual')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('id_pembeli')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('id_order')
                    ->references('id')
                    ->on('orders')
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
        Schema::dropIfExists('ratings');
    }
}

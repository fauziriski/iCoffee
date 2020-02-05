<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_order');
            $table->unsignedBigInteger('id_penjual');
            $table->bigInteger('invoice');
            $table->text('keterangan');
            $table->string('email');
            $table->string('gambar');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('id_pelanggan')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('id_order')
                    ->references('id')
                    ->on('orders')
                    ->onDelete('cascade');

            $table->foreign('id_penjual')
                    ->references('id')
                    ->on('users')
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
        Schema::dropIfExists('complaints');
    }
}

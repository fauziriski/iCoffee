<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestConfirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invest_confirms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_investor');
            $table->unsignedBigInteger('id_order');
            $table->string('bank');
            $table->string('nama');
            $table->bigInteger('nominal');
            $table->string('gambar');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invest_confirms');
    }
}

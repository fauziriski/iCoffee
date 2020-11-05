<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestorBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investor_banks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('investor_id');
            $table->foreign('investor_id')->references('id')->on('users');
            $table->string('bank_name');
            $table->string('name');
            $table->string('norek');
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
        Schema::dropIfExists('investor_banks');
    }
}

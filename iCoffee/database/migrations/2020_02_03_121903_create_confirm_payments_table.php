<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfirmPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirm_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->bigInteger('no_rekening_pengirim');
            $table->string('nama_bank_pengirim');
            $table->string('nama_pemilik_pengirim');
            $table->string('jasa');
            $table->bigInteger('no_telp');
            $table->bigInteger('jumlah_transfer');
            $table->string('invoice');
            $table->string('foto_bukti');
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
        Schema::dropIfExists('confirm_payments');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_penjualans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('id_mitra');
            $table->char('kode_produk');
            $table->integer('total_berat');
            $table->integer('total_penjualan');
            $table->string('bank')->nullable();
            $table->string('nama')->nullable();
            $table->string('gambar')->nullable();
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
        Schema::dropIfExists('riwayat_penjualans');
    }
}

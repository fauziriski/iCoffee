<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_penjualans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('kode_produk');
            $table->integer('berat_produk');
            $table->integer('harga_jual');
            $table->char('foto_produk');
            $table->char('foto_nota');
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
        Schema::dropIfExists('laporan_penjualans');
    }
}

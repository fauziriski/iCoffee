<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanDanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_danas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('produk');
            $table->integer('harga');
            $table->integer('jumlah');
            $table->bigInteger('total');
            $table->string('kode_produk');
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
        Schema::dropIfExists('pengajuan_danas');
    }
}

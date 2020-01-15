<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitraKoperasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mitra_koperasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_koperasi');
            $table->string('deskripsi');
            $table->string('alamat');
            $table->integer('jumlah_petani');
            $table->string('gambar');
            $table->string('ad_art');
            $table->string('akte');
            $table->string('ktp_pengurus');
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
        Schema::drop('mitra_koperasi');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitraTervalidasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mitra_tervalidasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_mitra')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nama_koperasi');
            $table->string('deskripsi');
            $table->string('alamat');
            $table->integer('jumlah_petani');
            $table->string('gambar');
            $table->string('no_hp');
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
        Schema::dropIfExists('mitra_tervalidasi');
    }
}

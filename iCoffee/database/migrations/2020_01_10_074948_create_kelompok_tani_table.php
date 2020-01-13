<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelompokTaniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelompok_tani', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_kelompok');
            $table->string('deskripsi');
            $table->string('alamat');
            $table->integer('jumlah_petani');
            $table->string('gambar');
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
        Schema::drop('kelompok_tani');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitraPeroranganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mitra_perorangan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_perorangan');
            $table->string('deskripsi');
            $table->string('alamat');
            $table->integer('jumlah_petani');
            $table->string('gambar');
            $table->string('kartu_keluarga');
            $table->string('surat_nikah');
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
        Schema::drop('mitra_perorangan');
    }
}

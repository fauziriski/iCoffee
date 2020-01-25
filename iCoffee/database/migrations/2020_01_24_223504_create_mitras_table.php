<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mitras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_mitra')->nullable();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('deskripsi');
            $table->string('alamat');
            $table->integer('jumlah_petani');
            $table->string('gambar');
            $table->string('no_hp');
            $table->string('kode');
            $table->rememberToken();
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
        Schema::dropIfExists('mitras');
    }
}

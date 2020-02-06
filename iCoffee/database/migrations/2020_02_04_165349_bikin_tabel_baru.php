<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BikinTabelBaru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('adm_kat_jurnal', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->string('kode_kat');
        //     $table->string('nama_kat');
        //     $table->timestamps();
        // });

        // Schema::create('adm_jurnal', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->unsignedBigInteger('id_kat_jurnal');
        //     $table->string('nama_tran');
        //     $table->string('bukti');
        //     $table->string('catatan');
        //     $table->string('kode');
        //     $table->string('total_jumlah');
        //     $table->string('tujuan_tran');
        //     $table->timestamps();

        //     $table->foreign('id_kat_jurnal')
        //     ->references('id')
        //     ->on('adm_kat_jurnal')
        //     ->onDelete('cascade');

        // });

        // Schema::create('adm_akun', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->unsignedBigInteger('id_adm_jurnal');
        //     $table->string('nama_akun');
        //     $table->string('posisi');
        //     $table->string('jumlah');
        //     $table->timestamps();

        //     $table->foreign('id_adm_jurnal')
        //     ->references('id')
        //     ->on('adm_jurnal')
        //     ->onDelete('cascade');
        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

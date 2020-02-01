<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_kat_jurnal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_kat');
            $table->timestamps();
        });

        Schema::create('adm_tranksaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_tran');
            $table->timestamps();
        });
        
        Schema::create('adm_kat_akun', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_kat');
            $table->timestamps();
        });

// FK
        Schema::create('adm_sub_akun', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_kat_akun');
            $table->string('nama_sub');
            $table->timestamps();

            $table->foreign('id_kat_akun')
            ->references('id')
            ->on('adm_kat_akun')
            ->onDelete('cascade');
        });

        Schema::create('adm_jurnal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_kat_jurnal');
            $table->unsignedBigInteger('id_tranksaksi');
            $table->string('nama_tran');
            $table->string('bukti');
            $table->string('catatan');
            $table->timestamps();

            $table->foreign('id_kat_jurnal')
            ->references('id')
            ->on('adm_kat_jurnal')
            ->onDelete('cascade');

            $table->foreign('id_tranksaksi')
            ->references('id')
            ->on('adm_tranksaksi')
            ->onDelete('cascade');

        });

        Schema::create('adm_akun', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_adm_jurnal');
            $table->string('nama_akun');
            $table->string('posisi');
            $table->string('kurs');
            $table->string('jumlah');
            $table->timestamps();

            $table->foreign('id_adm_jurnal')
            ->references('id')
            ->on('adm_jurnal')
            ->onDelete('cascade');
        });

        


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adm_kat_jurnal');
        Schema::dropIfExists('adm_kat_akun');
        Schema::dropIfExists('adm_tranksaksi');
        Schema::dropIfExists('adm_sub_akun');
        Schema::dropIfExists('adm_jurnal');
        Schema::dropIfExists('adm_akun');
    }
}

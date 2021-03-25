<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAktKeuanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akt_kat_jurnal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_kategori');
            $table->string('kode');
            $table->timestamps();
        });

        Schema::create('akt_kat_akun', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_kategori');
            $table->string('saldo_normal');
            $table->timestamps();
        });

        Schema::create('akt_tujuan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_tujuan');
            $table->timestamps();
        });
        

        // FK
        Schema::create('akt_akun', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_kat_akun');
            $table->string('no_akun')->unique();
            $table->string('nama_akun');
            $table->timestamps();

            $table->foreign('id_kat_akun')
            ->references('id')
            ->on('akt_kat_akun')
            ->onDelete('cascade');
        });

        Schema::create('akt_jurnal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_kat_jurnal');
            $table->unsignedBigInteger('id_akt_tujuan');
            $table->string('no_transaksi')->unique();
            $table->string('nama_transaksi');
            $table->string('bukti');
            $table->string('catatan');
            $table->bigInteger('total_jumlah');
            $table->timestamps();

            $table->foreign('id_kat_jurnal')
            ->references('id')
            ->on('akt_kat_jurnal')
            ->onDelete('cascade');

            $table->foreign('id_akt_tujuan')
            ->references('id')
            ->on('akt_tujuan')
            ->onDelete('cascade');

        });

        Schema::create('akt_akun_jurnal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_akt_jurnal');
            $table->unsignedBigInteger('id_akt_akun');
            $table->string('no_jurnal');
            $table->bigInteger('debit');
            $table->bigInteger('kredit');
            $table->timestamps();

            $table->foreign('id_akt_jurnal')
            ->references('id')
            ->on('akt_jurnal')
            ->onDelete('cascade');

            $table->foreign('id_akt_akun')
            ->references('id')
            ->on('akt_akun')
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
        Schema::dropIfExists('akt_kat_jurnal');
        Schema::dropIfExists('akt_kat_akun');
        Schema::dropIfExists('akt_tujuan');
        Schema::dropIfExists('akt_akun');
        Schema::dropIfExists('akt_jurnal');
        Schema::dropIfExists('akt_akun_jurnal');
    }
}

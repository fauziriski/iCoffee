<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToAdmAkun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adm_akun', function (Blueprint $table) {
            $table->string('no_jurnal')->unique()->after('id_adm_jurnal');
            $table->string('debit')->after('nama_akun');
            $table->string('kredit')->after('debit');
        });



        Schema::table('adm_jurnal', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kat_jurnal')->after('id');
            $table->foreign('id_kat_jurnal')
            ->references('id')
            ->on('adm_kat_jurnal')
            ->onDelete('cascade');

            $table->string('no_tran')->unique()->after('id_kat_jurnal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adm_akun', function (Blueprint $table) {
            //
        });

        Schema::table('adm_jurnal', function (Blueprint $table) {
            //
        });
    }
}

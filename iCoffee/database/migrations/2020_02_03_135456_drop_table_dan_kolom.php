<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTableDanKolom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adm_jurnal', function (Blueprint $table) {
            $table->dropColumn('id_kat_jurnal');
        });

        Schema::table('adm_jurnal', function (Blueprint $table) {
            $table->dropColumn('id_tranksaksi');
        });

        Schema::table('adm_jurnal', function (Blueprint $table) {
            $table->string('tujuan_tran');
        });

        Schema::drop('adm_kat_jurnal');
        Schema::drop('adm_tranksaksi');
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

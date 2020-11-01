<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKolomTabelAdmAkun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adm_akun', function (Blueprint $table) {
            $table->string('akun_debit')->after('no_jurnal');
            $table->string('akun_kredit')->after('akun_debit');
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
    }
}

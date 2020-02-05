<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKolomToAdm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::table('adm_kat_akun', function (Blueprint $table) {
            $table->string('no_akun');
        });

        Schema::table('adm_sub1_akun', function (Blueprint $table) {
            $table->string('no_akun');
        });

        Schema::table('adm_sub2_akun', function (Blueprint $table) {
            $table->string('no_akun');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adm_kat_akun', function (Blueprint $table) {
            //
        });

        Schema::table('adm_sub1_akun', function (Blueprint $table) {
            //
        });

        Schema::table('adm_sub2_akun', function (Blueprint $table) {
            //
        });
    }
}


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailHpToMitra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mitra_koperasi', function (Blueprint $table) {
            $table->string('email');
            $table->string('no_hp');
        });

        Schema::table('mitra_perorangan', function (Blueprint $table) {
            $table->string('email');
            $table->string('no_hp');
        });

        Schema::table('kelompok_tani', function (Blueprint $table) {
            $table->string('email');
            $table->string('no_hp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mitra', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKodeToMitraKoperasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mitra_koperasi', function (Blueprint $table) {
            $table->string('kode');
        });
        Schema::table('mitra_perorangan', function (Blueprint $table) {
            $table->string('kode');
        });
        Schema::table('mitra_tervalidasi', function (Blueprint $table) {
            $table->string('kode');
        });
        Schema::table('kelompok_tani', function (Blueprint $table) {
            $table->string('kode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mitra_koperasi', function (Blueprint $table) {
            $table->dropColumn('kode');
        });
        Schema::table('mitra_perorangan', function (Blueprint $table) {
            $table->dropColumn('kode');
        });
        Schema::table('mitra_tervalidasi', function (Blueprint $table) {
            $table->dropColumn('kode');
        });
        Schema::table('kelompok_tani', function (Blueprint $table) {
            $table->dropColumn('kode');
        });
    }
}

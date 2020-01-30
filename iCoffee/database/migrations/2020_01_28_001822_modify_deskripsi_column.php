<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDeskripsiColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mitras', function (Blueprint $table) {
            $table->text('deskripsi')->change();
        });

        Schema::table('kelompok_tani', function (Blueprint $table) {
            $table->text('deskripsi')->change();
        });

        Schema::table('mitra_koperasi', function (Blueprint $table) {
            $table->text('deskripsi')->change();
        });

        Schema::table('mitra_perorangan', function (Blueprint $table) {
            $table->text('deskripsi')->change();
        });
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdPenggunaToKelompokTani extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelompok_tani', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pengguna');

            $table->foreign('id_pengguna')
                ->references('id')
                ->on('users')
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
        Schema::table('kelompok_tani', function (Blueprint $table) {
            //
            $table->dropColumn('id_pengguna');
        });
    }
}

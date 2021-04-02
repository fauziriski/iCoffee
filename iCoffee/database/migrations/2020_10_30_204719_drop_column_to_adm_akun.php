<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnToAdmAkun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('adm_akun', function (Blueprint $table) {
        //     $table->dropColumn('posisi');
        //     $table->dropColumn('jumlah');
        // });

        // Schema::table('adm_jurnal', function (Blueprint $table) {
        //     $table->dropColumn('kode');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('adm_akun', function (Blueprint $table) {
        //     //
        // });
    }
}

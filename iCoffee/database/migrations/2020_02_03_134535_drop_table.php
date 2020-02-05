<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

       Schema::table('adm_jurnal', function (Blueprint $table) {
        $table->dropForeign(['id_kat_jurnal']);
    });


       Schema::table('adm_jurnal', function (Blueprint $table) {
         $table->dropForeign(['id_tranksaksi']);
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

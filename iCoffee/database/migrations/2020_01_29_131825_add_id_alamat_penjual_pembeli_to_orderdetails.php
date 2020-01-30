<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdAlamatPenjualPembeliToOrderdetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orderdetails', function (Blueprint $table) {
            $table->unsignedBigInteger('id_alamat_penjual');


            //    $table->foreign('id_alamat_penjual')
            //             ->references('id')
            //             ->on('addresses')
            //             ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orderdetails', function (Blueprint $table) {
            // $table->dropForeign(['id_alamat_penjual']);
            $table->dropColumn('id_alamat_penjual');
           
        });
    }
}

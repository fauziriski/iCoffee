<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnFromDeliveries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliveries', function (Blueprint $table) {
            $table->dropForeign(['id_pengiriman']);
            $table->dropColumn('id_pengiriman');
            $table->dropColumn('asal');
            $table->dropColumn('tujuan');

            $table->unsignedBigInteger('id_orderdetails');
            $table->string('nama')->after('id_orderdetails');
            $table->string('invoice')->after('nama');


            $table->foreign('id_orderdetails')
            ->references('id')
            ->on('orderdetails')
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
        Schema::table('deliveries', function (Blueprint $table) {
            $table->dropColumn('nama');
            $table->dropColumn('invoice');
            $table->dropColumn('id_orderdetails');
        });
    }
}

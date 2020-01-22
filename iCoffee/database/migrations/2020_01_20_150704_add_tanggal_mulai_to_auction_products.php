<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTanggalMulaiToAuctionProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('auction_products', function (Blueprint $table) {
        //     $table->dateTimeTz('tanggal_mulai')->after('kode_lelang');
        //     $table->dateTimeTz('tanggal_berakhir')->after('tanggal_mulai');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('auction_products', function (Blueprint $table) {
        //     $table->dropColumn('tanggal_mulai');
        //     $table->dropColumn('tanggal_berakhir');
        // });
    }
}

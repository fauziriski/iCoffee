<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDetailProdukOnInvestProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invest_product', function (Blueprint $table) {
            // $table->renameColumn('kota/kabupaten', 'kota_kabupaten');
            $table->text('detail_produk')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invest_product', function (Blueprint $table) {
            // $table->renameColumn('kota/kabupaten', 'kota_kabupaten');
            $table->text('detail_produk')->change();
        });
    }
}

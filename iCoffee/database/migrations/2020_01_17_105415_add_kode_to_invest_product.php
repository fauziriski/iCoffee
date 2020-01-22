<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKodeToInvestProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invest_product', function (Blueprint $table) {
            $table->string('kode_produk');
        });

        Schema::table('invest_product_images', function (Blueprint $table) {
            $table->string('kode_produk');
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
            $table->dropColumn('kode_produk');
        });

        Schema::table('invest_product_images', function (Blueprint $table) {
            $table->dropColumn('kode_produk');
        });
    }
}

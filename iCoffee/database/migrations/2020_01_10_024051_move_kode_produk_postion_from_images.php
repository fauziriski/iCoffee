<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoveKodeProdukPostionFromImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->string('kode_produk')->after('id_produk');
        });

        Schema::table('shop_products', function (Blueprint $table) {
            $table->string('kode_produk')->after('id_kategori');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->string('kode_produk')->after('updated_at');
        });

        Schema::table('shop_products', function (Blueprint $table) {
            $table->string('kode_produk')->after('updated_at');
        });
    }
}

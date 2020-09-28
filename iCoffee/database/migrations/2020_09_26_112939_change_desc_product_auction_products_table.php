<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDescProductAuctionProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auction_products', function (Blueprint $table) {
            $table->text('desc_produk')->change();
            $table->text('gambar')->change();
            // $table->string('id_kategori')->after('id_pelelang');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auction_products', function (Blueprint $table) {
            // $table->string('id_kategori')->after('updated_at');
            $table->string('desc_produk')->change();
            $table->string('gambar')->change();
        });
    }
}

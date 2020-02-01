<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeteleForeginkeyFromDeliveries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliveries', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kategori_kurir');

            $table->foreign('id_kategori_kurir')
                ->references('id')
                ->on('delivery_categories')
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
            $table->dropForeign(['id_kategori_kurir']);

            $table->dropColumn('id_kategori_kurir');

        });
    }
}

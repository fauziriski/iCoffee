<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteIdAlamatFromOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['id_alamat']);

            $table->foreign('id_alamat')
                ->references('id')
                ->on('addresses')
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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['id_alamat']);

            $table->foreign('id_alamat')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
        });
    }
}

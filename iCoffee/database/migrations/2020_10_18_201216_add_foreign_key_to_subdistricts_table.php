<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToSubdistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subdistricts', function (Blueprint $table) {
            $table->unsignedBigInteger('city_id')->change();
            $table->unsignedBigInteger('province_id')->change();
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');

            $table->foreign('province_id')
                ->references('id')
                ->on('provinces')
                ->onDelete('cascade');
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->unsignedBigInteger('kecamatan')->change();
            $table->foreign('kecamatan')
                ->references('id')
                ->on('subdistricts')
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
        Schema::table('subdistricts', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropForeign(['province_id']);
             
        });
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign(['kecamatan']);
        });
    }
}

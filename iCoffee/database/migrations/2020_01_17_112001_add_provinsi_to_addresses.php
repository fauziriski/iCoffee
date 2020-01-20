<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProvinsiToAddresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            
            $table->unsignedBigInteger('provinsi')->after('nama');
            $table->unsignedBigInteger('kota_kabupaten')->after('provinsi');

            $table->foreign('provinsi')
                    ->references('id')
                    ->on('provinces')
                    ->onDelete('cascade');

             $table->foreign('kota_kabupaten')
                    ->references('id')
                    ->on('cities')
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
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('provinsi');
            $table->dropColumn('kota_kabupaten');
        });
    }
}

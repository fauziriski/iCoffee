<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKodeProdukToInvestProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invest_product', function (Blueprint $table) {
            $table->renameColumn('id_kelompok_tani', 'id_mitra');
            $table->renameColumn('bunga', 'roi');
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
            //
        });
    }
}

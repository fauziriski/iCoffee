<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeteleForeginkeyIdOrderdetailsFromDeliveries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliveries', function (Blueprint $table) {

            $table->dropForeign(['id_orderdetails']);

            $table->renameColumn('id_orderdetails', 'id_order');

            $table->string('invoice')->nullable()->change();

            $table->foreign('id_order')
                        ->references('id')
                        ->on('orders')
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
            $table->dropForeign(['id_order']);

            $table->renameColumn('id_order', 'id_orderdetails');

            $table->foreign('id_orderdetails')
                    ->references('id')
                    ->on('orderdetails')
                    ->onDelete('cascade');
        });
    }
}

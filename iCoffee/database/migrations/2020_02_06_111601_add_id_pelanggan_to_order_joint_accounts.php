<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdPelangganToOrderJointAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_joint_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pelanggan');
            $table->integer('jumlah_top_up');
            $table->bigInteger('kode_top_up');
            $table->integer('status');

            $table->foreign('id_pelanggan')
                    ->references('id')
                    ->on('users')
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
        Schema::table('order_joint_accounts', function (Blueprint $table) {
            $table->dropForeign(['id_pelanggan']);
            $table->dropColumn('id_pelanggan');
            $table->dropColumn('status');
            $table->dropColumn('kode_top_up');
            $table->dropColumn('jumlah_top_up');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeIdPelangganFromJointAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('joint_accounts', function (Blueprint $table) {
            $table->renameColumn('id_pelanggan', 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('joint_accounts', function (Blueprint $table) {
            $table->renameColumn('user_id', 'id_pelanggan');
        });
    }
}

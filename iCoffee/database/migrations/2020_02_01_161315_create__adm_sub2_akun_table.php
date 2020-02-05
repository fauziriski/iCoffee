<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmSub2AkunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('adm_sub2_akun', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_kat_akun');
            $table->unsignedBigInteger('id_sub1_akun');
            $table->string('nama_sub');
            $table->timestamps();

            $table->foreign('id_kat_akun')
            ->references('id')
            ->on('adm_kat_akun')
            ->onDelete('cascade');

            $table->foreign('id_sub1_akun')
            ->references('id')
            ->on('adm_sub1_akun')
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
        Schema::dropIfExists('adm_sub2_akun');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelBlog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artikel_blog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul');
            $table->text('body');
            $table->string('slug');
            $table->text('gambar');
            $table->unsignedBigInteger('kategori_artikel_id');
            $table->foreign('kategori_artikel_id')->references('id')->on('kategori_artikel')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artikel_blog');
    }
}

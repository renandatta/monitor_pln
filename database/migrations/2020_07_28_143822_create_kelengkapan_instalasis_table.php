<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelengkapanInstalasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelengkapan_instalasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instalasi_id');
            $table->unsignedBigInteger('item_kelengkapan_id');
            $table->text('konten')->nullable();
            $table->string('status')->default('')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('instalasi_id')->references('id')->on('instalasi');
            $table->foreign('item_kelengkapan_id')->references('id')->on('item_kelengkapan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelengkapan_instalasi');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelengkapanInstalasiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelengkapan_instalasi_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelengkapan_instalasi_id');
            $table->unsignedBigInteger('item_kelengkapan_id');
            $table->string('status');
            $table->text('konten');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('kelengkapan_instalasi_id')->references('id')->on('kelengkapan_instalasi');
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
        Schema::dropIfExists('kelengkapan_instalasi_detail');
    }
}

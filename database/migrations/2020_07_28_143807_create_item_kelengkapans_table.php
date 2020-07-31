<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemKelengkapansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_kelengkapan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grup_slo_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('no_urut');
            $table->string('nama');
            $table->string('jenis');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('grup_slo_id')->references('id')->on('grup_slo');
            $table->foreign('parent_id')->references('id')->on('item_kelengkapan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_kelengkapan');
    }
}

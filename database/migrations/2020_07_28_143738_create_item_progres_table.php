<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemProgresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_progres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grup_slo_id');
            $table->string('nama');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('grup_slo_id')->references('id')->on('grup_slo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_progres');
    }
}

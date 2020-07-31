<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgresInstalasiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progres_instalasi_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('progres_instalasi_id');
            $table->unsignedBigInteger('item_progres_id');
            $table->decimal('progres', 5, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('progres_instalasi_id')->references('id')->on('progres_instalasi');
            $table->foreign('item_progres_id')->references('id')->on('item_progres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progres_instalasi_details');
    }
}

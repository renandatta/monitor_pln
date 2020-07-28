<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgresInstalasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progres_instalasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instalasi_id');
            $table->unsignedBigInteger('item_progres_id');
            $table->decimal('progres', 5, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('instalasi_id')->references('id')->on('instalasi');
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
        Schema::dropIfExists('progres_instalasis');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstalasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instalasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jalur_id');
            $table->string('nama');
            $table->string('koordinat');
            $table->string('status')->default('')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('jalur_id')->references('id')->on('instalasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instalasi');
    }
}

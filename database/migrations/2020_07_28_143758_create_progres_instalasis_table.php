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
        Schema::create('progres_instalasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instalasi_id');
            $table->unsignedBigInteger('grup_slo_id');
            $table->decimal('progres_jalur', 5, 2)->default(0);
            $table->decimal('progres_bay', 5, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('instalasi_id')->references('id')->on('instalasi');
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
        Schema::dropIfExists('progres_instalasi');
    }
}

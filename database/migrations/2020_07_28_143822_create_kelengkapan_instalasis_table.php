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
            $table->unsignedBigInteger('grup_slo_id');
            $table->unsignedBigInteger('kontraktor_id');
            $table->unsignedBigInteger('petugas_id');
            $table->string('lingkup');
            $table->text('alamat');
            $table->string('koordinat');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('instalasi_id')->references('id')->on('instalasi');
            $table->foreign('grup_slo_id')->references('id')->on('grup_slo');
            $table->foreign('kontraktor_id')->references('id')->on('kontraktor');
            $table->foreign('petugas_id')->references('id')->on('petugas');
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInstalasiTableRemoveColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelengkapan_instalasi', function (Blueprint $table) {
            $table->dropForeign(['kontraktor_id']);
            $table->dropForeign(['petugas_id']);
            $table->dropColumn('kontraktor_id');
            $table->dropColumn('petugas_id');
            $table->dropColumn('lingkup');
            $table->dropColumn('alamat');
            $table->dropColumn('koordinat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelengkapan_instalasi', function (Blueprint $table) {
            $table->unsignedBigInteger('kontraktor_id')->nullable();
            $table->unsignedBigInteger('petugas_id')->nullable();
            $table->string('lingkup')->nullable();
            $table->text('alamat')->nullable();
            $table->string('koordinat')->nullable();
            $table->foreign('kontraktor_id')->references('id')->on('kontraktor');
            $table->foreign('petugas_id')->references('id')->on('petugas');
        });
    }
}

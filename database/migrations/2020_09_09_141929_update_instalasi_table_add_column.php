<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInstalasiTableAddColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instalasi', function (Blueprint $table) {
            $table->unsignedBigInteger('kontraktor_id')->nullable();
            $table->unsignedBigInteger('petugas_id')->nullable();
            $table->string('lingkup')->nullable();
            $table->text('alamat')->nullable();
            $table->string('koordinat')->nullable();
            $table->string('no_surat_inspeksi')->nullable();
            $table->date('tanggal_surat_inspeksi')->nullable();
            $table->string('no_slb')->nullable();
            $table->date('tanggal_slb')->nullable();
            $table->date('tanggal_energize')->nullable();
            $table->string('no_st1')->nullable();
            $table->date('tanggal_st1')->nullable();
            $table->string('no_st2')->nullable();
            $table->date('tanggal_st2')->nullable();
            $table->double('nilai_final')->nullable();
            $table->string('no_slo')->nullable();
            $table->date('tanggal_slo')->nullable();
            $table->string('no_stop')->nullable();
            $table->date('tanggal_stop')->nullable();
            $table->string('no_stap')->nullable();
            $table->date('tanggal_stap')->nullable();
            $table->string('no_stp')->nullable();
            $table->date('tanggal_stp')->nullable();
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
        Schema::table('instalasi', function (Blueprint $table) {
            $table->dropForeign(['kontraktor_id']);
            $table->dropForeign(['petugas_id']);
            $table->dropColumn('kontraktor_id');
            $table->dropColumn('petugas_id');
            $table->dropColumn('lingkup');
            $table->dropColumn('alamat');
            $table->dropColumn('koordinat');
            $table->dropColumn('no_surat_inspeksi');
            $table->dropColumn('tanggal_surat_inspeksi');
            $table->dropColumn('no_slb');
            $table->dropColumn('tanggal_slb');
            $table->dropColumn('tanggal_energize');
            $table->dropColumn('no_st1');
            $table->dropColumn('tanggal_st1');
            $table->dropColumn('no_st2');
            $table->dropColumn('tanggal_st2');
            $table->dropColumn('nilai_final');
            $table->dropColumn('no_slo');
            $table->dropColumn('no_stop');
            $table->dropColumn('tanggal_stop');
            $table->dropColumn('no_stap');
            $table->dropColumn('tanggal_stap');
            $table->dropColumn('no_stp');
            $table->dropColumn('tanggal_stp');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateKelengkapanInstalasiDetailTableAddPesanTolak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelengkapan_instalasi_detail', function (Blueprint $table) {
            $table->string('pesan_tolak')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelengkapan_instalasi_detail', function (Blueprint $table) {
            $table->dropColumn('pesan_tolak');
        });
    }
}

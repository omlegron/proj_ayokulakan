<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTransJadwalsHajiUmrohs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_trans_haji_jadwal', function (Blueprint $table) {
            $table->dropColumn(['paket_id']);
            $table->string('type_paket')->nullable();
            $table->longText('keterangan_paket')->nullable();
        });
        Schema::table('trans_haji_jadwal', function (Blueprint $table) {
            $table->dropColumn(['paket_id']);
            $table->string('type_paket')->nullable();
            $table->longText('keterangan_paket')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_trans_haji_jadwal', function (Blueprint $table) {
            $table->integer('paket_id')->nullable();
            $table->dropColumn(['type_paket'])->nullable();
            $table->dropColumn(['keterangan_paket'])->nullable();
        });
        Schema::table('trans_haji_jadwal', function (Blueprint $table) {
           $table->integer('paket_id')->nullable();
            $table->dropColumn(['type_paket'])->nullable();
            $table->dropColumn(['keterangan_paket'])->nullable();
        });
    }
}

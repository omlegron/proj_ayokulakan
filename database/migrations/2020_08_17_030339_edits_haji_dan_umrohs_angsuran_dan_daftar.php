<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditsHajiDanUmrohsAngsuranDanDaftar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_trans_haji_daftar', function (Blueprint $table) {
            $table->dropColumn(['id_paket']);
        });
        Schema::table('trans_haji_daftar', function (Blueprint $table) {
            $table->dropColumn(['id_paket']);
        });

        Schema::table('log_trans_haji_angsuran', function (Blueprint $table) {
            $table->dropColumn(['id_paket']);
        });
        Schema::table('trans_haji_angsuran', function (Blueprint $table) {
            $table->dropColumn(['id_paket']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_trans_haji_daftar', function (Blueprint $table) {
            $table->integer('id_paket');
        });
        Schema::table('trans_haji_daftar', function (Blueprint $table) {
            $table->integer('id_paket');
        });

        Schema::table('log_trans_haji_angsuran', function (Blueprint $table) {
            $table->integer('id_paket');
        });
        Schema::table('trans_haji_angsuran', function (Blueprint $table) {
            $table->integer('id_paket');
        });
    }
}

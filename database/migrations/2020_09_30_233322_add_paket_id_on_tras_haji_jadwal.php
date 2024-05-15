<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaketIdOnTrasHajiJadwal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_haji_jadwal', function (Blueprint $table) {
            $table->integer('paket_id')->unsigned();
            $table->foreign('paket_id')->references('id')->on('trans_haji_paket')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('log_trans_haji_jadwal', function (Blueprint $table) {
            $table->integer('paket_id')->unsigned();
            $table->foreign('paket_id')->references('id')->on('trans_haji_paket')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trans_haji_jadwal', function (Blueprint $table) {
            $table->dropColumn('paket_id');
        });
        Schema::table('log_trans_haji_jadwal', function (Blueprint $table) {
            $table->dropColumn('paket_id');
        });
    }
}

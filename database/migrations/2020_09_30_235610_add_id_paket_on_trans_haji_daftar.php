<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdPaketOnTransHajiDaftar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_haji_daftar', function (Blueprint $table) {
            $table->integer('id_paket')->unsigned()->after('id_jadwal');
            $table->foreign('id_paket')->references('id')->on('trans_haji_paket')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('log_trans_haji_daftar', function (Blueprint $table) {
            $table->integer('id_paket')->unsigned()->after('id_jadwal');
            $table->foreign('id_paket')->references('id')->on('trans_haji_paket')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trans_haji_daftar', function (Blueprint $table) {
            $table->dropColumn('id_paket');
        });
        Schema::table('trans_haji_daftar', function (Blueprint $table) {
            $table->dropColumn('id_paket');
        });
    }
}

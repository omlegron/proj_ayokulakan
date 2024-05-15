<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdKelurahanOnTransLapak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_lapak', function (Blueprint $table) {
            $table->integer('id_kelurahan')->unsigned()->after('id_kecamatan');
        });
        Schema::table('log_trans_lapak', function (Blueprint $table) {
            $table->integer('id_kelurahan')->unsigned()->after('id_kecamatan');
        });
        Schema::table('sys_users', function (Blueprint $table) {
            $table->integer('id_kelurahan')->unsigned()->after('id_kecamatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trans_lapak', function (Blueprint $table) {
            $table->dropColumn('id_kelurahan');
        });
        Schema::table('log_trans_lapak', function (Blueprint $table) {
            $table->dropColumn('id_kelurahan');
        });
        Schema::table('sys_users', function (Blueprint $table) {
            $table->dropColumn('id_kelurahan');
        });
    }
}

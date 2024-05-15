<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWilayahToTransRentalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_rental', function (Blueprint $table) {
            $table->string('id_kecamatan')->after('waktu_sewa')->nullable();
            $table->string('id_kota')->after('waktu_sewa')->nullable();
            $table->string('id_provinsi')->after('waktu_sewa')->nullable();
            $table->string('id_negara')->after('waktu_sewa')->nullable();
        });
        Schema::table('log_trans_rental', function (Blueprint $table) {
            $table->string('id_kecamatan')->after('waktu_sewa')->nullable();
            $table->string('id_kota')->after('waktu_sewa')->nullable();
            $table->string('id_provinsi')->after('waktu_sewa')->nullable();
            $table->string('id_negara')->after('waktu_sewa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trans_rental', function (Blueprint $table) {
            $table->dropColumn('id_kecamatan');
            $table->dropColumn('id_kota');
            $table->dropColumn('id_provinsi');
            $table->dropColumn('id_negara');
        });
        Schema::table('log_trans_rental', function (Blueprint $table) {
            $table->dropColumn('id_kecamatan');
            $table->dropColumn('id_kota');
            $table->dropColumn('id_provinsi');
            $table->dropColumn('id_negara');
        });
    }
}

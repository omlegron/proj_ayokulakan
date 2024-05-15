<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiscOnLapakBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_lapak_barang', function (Blueprint $table) {
            $table->string('disc_barang')->nullable()->after('berat_barang');
            $table->string('harga_normal')->nullable()->after('satuan_barang');
        });
        Schema::table('log_trans_lapak_barang', function (Blueprint $table) {
            $table->string('disc_barang')->nullable()->after('berat_barang');
            $table->string('harga_normal')->nullable()->after('satuan_barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trans_lapak_barang', function (Blueprint $table) {
            $table->dropColumn('disc_barang');
            $table->dropColumn('harga_normal');
        });
        Schema::table('log_trans_lapak_barang', function (Blueprint $table) {
            $table->dropColumn('disc_barang');
            $table->dropColumn('harga_normal');
        });
    }
}

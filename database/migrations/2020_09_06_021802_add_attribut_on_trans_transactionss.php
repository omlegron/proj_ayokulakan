<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributOnTransTransactionss extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_ampas_transaksi_barang_detail', function (Blueprint $table) {
            $table->string('status_barang')->default('Menunggu Pembayaran')->comment('Menunggu Pembayaran, Sedang Di Packing, Dalam Pengiriman, Telah Diterima, Proses Pengembalian, Pengembalian Berhasil, Pesanan Dibatalkan')->nullable();
        });

        Schema::table('log_trans_ampas_transaksi_barang_detail', function (Blueprint $table) {
            $table->string('status_barang')->default('Menunggu Pembayaran')->comment('Menunggu Pembayaran, Sedang Di Packing, Dalam Pengiriman, Telah Diterima, Proses Pengembalian, Pengembalian Berhasil, Pesanan Dibatalkan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trans_ampas_transaksi_barang_detail', function (Blueprint $table) {
            $table->dropColumn(['status_barang']);
        });

        Schema::table('log_trans_ampas_transaksi_barang_detail', function (Blueprint $table) {
            $table->dropColumn(['status_barang']);
        });
    }
}

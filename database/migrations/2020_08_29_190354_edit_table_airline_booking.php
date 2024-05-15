<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTableAirlineBooking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('log_trans_ampas_transaksi_attach')->truncate();
        DB::table('log_trans_ampas_transaksi_barang_detail')->truncate();
        DB::table('log_trans_ampas_transaksi_prepaid')->truncate();
        DB::table('log_trans_ampas_transaksi_postpaid')->truncate();
        DB::table('log_trans_ampas_transaksi_kurir')->truncate();
        DB::table('log_trans_ampas_transaksi_kereta')->truncate();
        DB::table('log_trans_ampas_transaksi')->truncate();

        DB::table('trans_ampas_transaksi_attach')->truncate();
        DB::table('trans_ampas_transaksi_barang_detail')->truncate();
        DB::table('trans_ampas_transaksi_prepaid')->truncate();
        DB::table('trans_ampas_transaksi_postpaid')->truncate();
        DB::table('trans_ampas_transaksi_kurir')->truncate();
        DB::table('trans_ampas_transaksi_kereta')->truncate();
        DB::table('notification_feedback')->truncate();
        DB::table('trans_ampas_transaksi')->delete();
        DB::table('airline_bookings')->truncate();


        Schema::table('airline_bookings', function (Blueprint $table) {
            $table->string('status')->nullable();
            $table->string('respMessage')->nullable();
            $table->integer('trans_id')->unsigned()->nullable();
            $table->foreign('trans_id')->references('id')->on('trans_ampas_transaksi')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('log_trans_ampas_transaksi', function (Blueprint $table) {
            $table->bigInteger('target_id')->nullable();
            $table->string('target_type')->nullable();
        });
        Schema::table('trans_ampas_transaksi', function (Blueprint $table) {
            $table->bigInteger('target_id')->nullable();
            $table->string('target_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('airline_bookings', function (Blueprint $table) {
            $table->dropColumn(['status']);
            $table->dropColumn(['respMessage']);
            $table->dropForeign(['trans_id']);
            $table->dropColumn(['trans_id']);
        });

        Schema::table('log_trans_ampas_transaksi', function (Blueprint $table) {
            $table->dropColumn(['target_id']);
            $table->dropColumn(['target_type']);
        });

        Schema::table('trans_ampas_transaksi', function (Blueprint $table) {
            $table->dropColumn(['target_id']);
            $table->dropColumn(['target_type']);
        });
    }
}

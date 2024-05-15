<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankOnTransAmpasTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_ampas_transaksi', function (Blueprint $table) {
            $table->string('bank')->nullable()->after('store');
            $table->string('card_number')->nullable()->after('bank');
        });
        Schema::table('log_trans_ampas_transaksi', function (Blueprint $table) {
            $table->string('bank')->nullable()->after('store');
            $table->string('card_number')->nullable()->after('bank');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trans_ampas_transaksi', function (Blueprint $table) {
            $table->dropColumn('bank');
            $table->dropColumn('card_number');
        });
        Schema::table('log_trans_ampas_transaksi', function (Blueprint $table) {
            $table->dropColumn('bank');
            $table->dropColumn('card_number');
        });
    }
}

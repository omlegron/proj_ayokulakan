<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributeOnTrasactionNewlah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('log_trans_ampas_transaksi', function (Blueprint $table) {
            $table->string('ppob_sn')->nullable();
            $table->string('ppob_pin')->nullable();
        });

        Schema::table('trans_ampas_transaksi', function (Blueprint $table) {
            $table->string('ppob_sn')->nullable();
            $table->string('ppob_pin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_trans_ampas_transaksi', function (Blueprint $table) {
            $table->dropColumn(['ppob_sn']);
            $table->dropColumn(['ppob_pin']);
        });

        Schema::table('trans_ampas_transaksi', function (Blueprint $table) {
            $table->dropColumn(['ppob_sn']);
            $table->dropColumn(['ppob_pin']);
        });
    }
}

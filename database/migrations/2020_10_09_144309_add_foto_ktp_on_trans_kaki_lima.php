<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFotoKtpOnTransKakiLima extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_kaki_lima', function (Blueprint $table) {
            $table->string('fotoktp')->nullable();
        });
        Schema::table('log_trans_kaki_lima', function (Blueprint $table) {
            $table->string('fotoktp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trans_kaki_lima', function (Blueprint $table) {
            $table->dropColumn('fotoktp');
        });
        Schema::table('log_trans_kaki_lima', function (Blueprint $table) {
            $table->dropColumn('fotoktp');
        });
    }
}

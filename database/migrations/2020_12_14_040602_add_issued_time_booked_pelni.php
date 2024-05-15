<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIssuedTimeBookedPelni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_trans_kapal_bookings', function (Blueprint $table) {
            $table->string('issuedDateTimeLimit')->nullable();
        });

        Schema::table('trans_kapal_bookings', function (Blueprint $table) {
            $table->string('issuedDateTimeLimit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_trans_kapal_bookings', function (Blueprint $table) {
            $table->string('issuedDateTimeLimit')->nullable();
        });

        Schema::table('trans_kapal_bookings', function (Blueprint $table) {
            $table->string('issuedDateTimeLimit')->nullable();
        });
    }
}

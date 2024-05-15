<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributeOnTransBookingKapal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_kapal_bookings', function (Blueprint $table) {
            $table->string('bokingNumber')->nullable();
            $table->string('kelasKapal')->nullable();
        });

        Schema::table('log_trans_kapal_bookings', function (Blueprint $table) {
            $table->string('bokingNumber')->nullable();
            $table->string('kelasKapal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trans_kapal_bookings', function (Blueprint $table) {
            $table->dropColumn(['bokingNumber']);
            $table->dropColumn(['kelasKapal']);
        });

        Schema::table('log_trans_kapal_bookings', function (Blueprint $table) {
            $table->dropColumn(['bokingNumber']);
            $table->dropColumn(['kelasKapal']);
        });
    }
}

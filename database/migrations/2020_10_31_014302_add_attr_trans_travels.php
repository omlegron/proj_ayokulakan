<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttrTransTravels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_travel_bookings', function (Blueprint $table) {
            $table->string('ticketPrice')->nullable();
        });

        Schema::table('log_trans_travel_bookings', function (Blueprint $table) {
            $table->string('ticketPrice')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('trans_travel_bookings', function (Blueprint $table) {
            $table->dropColumn(['ticketPrice']);
        });

        Schema::create('log_trans_travel_bookings', function (Blueprint $table) {
            $table->dropColumn(['ticketPrice']);
        });
    }
}

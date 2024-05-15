<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransBusBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_bus_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bus')->nullable();
            $table->string('operatorName')->nullable();
            $table->string('originTerminal')->nullable();
            $table->string('destinationTerminal')->nullable();
            $table->string('bookingCode')->nullable();
            $table->string('directCode')->nullable();
            $table->string('locationID')->nullable();
            $table->string('departPlace')->nullable();
            $table->string('departTime')->nullable();
            $table->string('bookingTime')->nullable();
            $table->string('salesPrice')->nullable();
            $table->string('memberDiscount')->nullable();
            $table->string('ticketPrice')->nullable();
            $table->string('issuedTimeLimit')->nullable();
            $table->string('accessToken')->nullable();
            $table->string('status')->nullable();
            $table->string('respMessage')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('log_trans_bus_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bus_id')->nullable();
            $table->string('bus')->nullable();
            $table->string('operatorName')->nullable();
            $table->string('originTerminal')->nullable();
            $table->string('destinationTerminal')->nullable();
            $table->string('bookingCode')->nullable();
            $table->string('directCode')->nullable();
            $table->string('locationID')->nullable();
            $table->string('departPlace')->nullable();
            $table->string('departTime')->nullable();
            $table->string('bookingTime')->nullable();
            $table->string('salesPrice')->nullable();
            $table->string('memberDiscount')->nullable();
            $table->string('ticketPrice')->nullable();
            $table->string('issuedTimeLimit')->nullable();
            $table->string('accessToken')->nullable();
            $table->string('status')->nullable();
            $table->string('respMessage')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_trans_bus_bookings');
        Schema::dropIfExists('trans_bus_bookings');
    }
}

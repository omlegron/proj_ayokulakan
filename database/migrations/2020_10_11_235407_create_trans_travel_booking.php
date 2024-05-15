<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransTravelBooking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_travel_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('shuttleID')->nullable();
            $table->string('bookingCode')->nullable();
            $table->string('salesPrice')->nullable();
            $table->string('memberCommission')->nullable();
            $table->string('ticketStatus')->nullable();
            $table->string('departTime')->nullable();
            $table->string('bookingDate')->nullable();
            $table->string('issuedTimeLimit')->nullable();
            $table->string('origin')->nullable();
            $table->string('destination')->nullable();
            $table->string('originCity')->nullable();
            $table->string('destinationCity')->nullable();
            $table->string('accessToken')->nullable();
            $table->string('status')->nullable();
            $table->string('respMessage')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('log_trans_travel_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('travel_id')->nullable();
            
            $table->string('shuttleID')->nullable();
            $table->string('bookingCode')->nullable();
            $table->string('salesPrice')->nullable();
            $table->string('memberCommission')->nullable();
            $table->string('ticketStatus')->nullable();
            $table->string('departTime')->nullable();
            $table->string('bookingDate')->nullable();
            $table->string('issuedTimeLimit')->nullable();
            $table->string('origin')->nullable();
            $table->string('destination')->nullable();
            $table->string('originCity')->nullable();
            $table->string('destinationCity')->nullable();
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
        Schema::dropIfExists('log_trans_travel_bookings');
        Schema::dropIfExists('trans_travel_bookings');
    }
}

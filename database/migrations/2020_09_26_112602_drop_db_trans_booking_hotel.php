<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropDbTransBookingHotel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('log_trans_hotel_bookings');
        Schema::dropIfExists('trans_hotel_bookings');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('trans_hotel_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('checkInDate')->nullable();
            $table->string('checkOutDate')->nullable();
            $table->string('bookingDate')->nullable();
            $table->string('internalCode')->nullable();
            $table->string('reservationNo')->nullable();
            $table->string('osRefNo')->nullable();
            $table->string('agentOsRef')->nullable();
            $table->string('bookingStatus')->nullable();
            $table->string('status')->nullable();
            $table->string('respMessage')->nullable();
            $table->string('accessToken')->nullable();
            
            $table->string('hotelID')->nullable();
            $table->string('hotelName')->nullable();
            $table->string('roomName')->nullable();
            $table->string('roomNum')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('log_trans_hotel_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hotel_id')->nullable();
            $table->string('checkInDate')->nullable();
            $table->string('checkOutDate')->nullable();
            $table->string('bookingDate')->nullable();
            $table->string('internalCode')->nullable();
            $table->string('reservationNo')->nullable();
            $table->string('osRefNo')->nullable();
            $table->string('agentOsRef')->nullable();
            $table->string('bookingStatus')->nullable();
            $table->string('status')->nullable();
            $table->string('respMessage')->nullable();
            $table->string('accessToken')->nullable();
            
            $table->string('hotelID')->nullable();
            $table->string('hotelName')->nullable();
            $table->string('roomName')->nullable();
            $table->string('roomNum')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });
    }
}

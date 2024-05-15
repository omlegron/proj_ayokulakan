<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewTransHotel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
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
            $table->bigInteger('price')->nullable();

            
            $table->text('paxPassport')->nullable();
            $table->text('countryID')->nullable();
            $table->text('cityID')->nullable();
            $table->string('roomType')->nullable();
            $table->string('isRequestChildBed')->nullable();
            $table->string('childNum')->nullable();
            $table->string('breakfast')->nullable();
            $table->string('roomID')->text();
            $table->string('smookingRoom')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->longText('alamat')->nullable();

            $table->string('bedTypeBed')->nullable();
            $table->string('bedTypeID')->nullable();

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
            $table->bigInteger('price')->nullable();

            $table->text('paxPassport')->nullable();
            $table->text('countryID')->nullable();
            $table->text('cityID')->nullable();
            $table->string('roomType')->nullable();
            $table->string('isRequestChildBed')->nullable();
            $table->string('childNum')->nullable();
            $table->string('breakfast')->nullable();
            $table->string('roomID')->text();
            $table->string('smookingRoom')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->longText('alamat')->nullable();

            $table->string('bedTypeBed')->nullable();
            $table->string('bedTypeID')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('trans_hotel_child_ages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hotel_id')->unsigned();
            $table->string('age')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
            $table->foreign('hotel_id')->references('id')->on('trans_hotel_bookings')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('trans_hotel_paxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hotel_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
            $table->foreign('hotel_id')->references('id')->on('trans_hotel_bookings')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trans_hotel_child_ages');
        Schema::dropIfExists('trans_hotel_paxes');
        Schema::dropIfExists('log_trans_hotel_bookings');
        Schema::dropIfExists('trans_hotel_bookings');
    }
}

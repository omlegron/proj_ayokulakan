<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatTransTourBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_tour_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('BookingCode')->nullable();
            $table->string('BookingDate')->nullable();
            $table->string('DepartDate')->nullable();
            $table->string('TicketStatus')->nullable();
            $table->string('TourName')->nullable();
            $table->string('Currency')->nullable();
            $table->string('TourVariant')->nullable();
            $table->string('PaymentType')->nullable();
            $table->string('TotalPrice')->nullable();
            $table->string('Commision')->nullable();
            $table->string('RemainingBill')->nullable();
            $table->string('DPAmount')->nullable();
            $table->string('accessToken')->nullable();
            $table->string('status')->nullable();
            $table->string('respMessage')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('log_trans_tour_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('tour_id')->nullable();
            $table->string('BookingCode')->nullable();
            $table->string('BookingDate')->nullable();
            $table->string('DepartDate')->nullable();
            $table->string('TicketStatus')->nullable();
            $table->string('TourName')->nullable();
            $table->string('Currency')->nullable();
            $table->string('TourVariant')->nullable();
            $table->string('PaymentType')->nullable();
            $table->string('TotalPrice')->nullable();
            $table->string('Commision')->nullable();
            $table->string('RemainingBill')->nullable();
            $table->string('DPAmount')->nullable();
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
        Schema::dropIfExists('trans_tour_bookings');
    }
}

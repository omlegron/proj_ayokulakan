<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransKapalBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_kapal_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numCode')->nullable();
            $table->string('departDate')->nullable();
            $table->string('salesPrice')->nullable();
            $table->string('memberDiscount')->nullable();
            $table->string('ticketPrice')->nullable();
            $table->string('shipMarkup')->nullable();
            $table->string('bookingDateTime')->nullable();
            $table->string('status')->nullable();
            $table->string('respMessage')->nullable();
            $table->string('accessToken')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('log_trans_kapal_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('kapal_id')->nullable();
            
            $table->string('numCode')->nullable();
            $table->string('departDate')->nullable();
            $table->string('salesPrice')->nullable();
            $table->string('memberDiscount')->nullable();
            $table->string('ticketPrice')->nullable();
            $table->string('shipMarkup')->nullable();
            $table->string('bookingDateTime')->nullable();
            $table->string('status')->nullable();
            $table->string('respMessage')->nullable();
            $table->string('accessToken')->nullable();
            
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
        Schema::dropIfExists('log_trans_kapal_bookings');
        Schema::dropIfExists('trans_kapal_bookings');
    }
}

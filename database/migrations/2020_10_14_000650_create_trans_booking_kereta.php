<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransBookingKereta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('trans_kereta_passengers');
        Schema::dropIfExists('trans_kereta_bookings');
        Schema::dropIfExists('log_trans_kereta_bookings');
        
        Schema::create('trans_kereta_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->text('tr_id')->nullable();
            $table->text('code')->nullable();
            $table->text('hp')->nullable();
            $table->text('tr_name')->nullable();
            $table->text('period')->nullable();
            $table->text('nominal')->nullable();
            $table->text('admin')->nullable();
            $table->text('ref_id')->nullable();
            $table->text('response_code')->nullable();
            $table->text('message')->nullable();
            $table->text('price')->nullable();
            $table->text('selling_price')->nullable();
            $table->text('bookingCode')->nullable();
            $table->text('bookingDateTime')->nullable();
            $table->text('bookingTimeLimit')->nullable();
            $table->text('trainName')->nullable();
            $table->text('trainNumber')->nullable();
            $table->text('class')->nullable();
            $table->text('subClass')->nullable();
            $table->text('org')->nullable();
            $table->text('departDate')->nullable();
            $table->text('departTime')->nullable();
            $table->text('dest')->nullable();
            $table->text('arriveDate')->nullable();
            $table->text('arriveTime')->nullable();
            $table->text('discount')->nullable();
            $table->longText('eticket')->nullable();
            $table->string('contactName')->nullable();
            $table->string('contactPhone')->nullable();
            $table->string('contactEmail')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('trans_kereta_passengers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('kereta_id')->nullable();
            
            $table->string('trID')->nullabele();

            $table->string('name')->nullabele();

            $table->string('category')->nullabele();

            $table->string('wagonCode')->nullabele();

            $table->string('seat')->nullabele();

            $table->string('amount')->nullabele();

            $table->string('refundStatus')->nullabele();

            $table->string('ticketNumber')->nullabele();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('log_trans_kereta_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('kereta_id')->nullable();
            
            $table->text('tr_id')->nullable();
            $table->text('code')->nullable();
            $table->text('hp')->nullable();
            $table->text('tr_name')->nullable();
            $table->text('period')->nullable();
            $table->text('nominal')->nullable();
            $table->text('admin')->nullable();
            $table->text('ref_id')->nullable();
            $table->text('response_code')->nullable();
            $table->text('message')->nullable();
            $table->text('price')->nullable();
            $table->text('selling_price')->nullable();
            $table->text('bookingCode')->nullable();
            $table->text('bookingDateTime')->nullable();
            $table->text('bookingTimeLimit')->nullable();
            $table->text('trainName')->nullable();
            $table->text('trainNumber')->nullable();
            $table->text('class')->nullable();
            $table->text('subClass')->nullable();
            $table->text('org')->nullable();
            $table->text('departDate')->nullable();
            $table->text('departTime')->nullable();
            $table->text('dest')->nullable();
            $table->text('arriveDate')->nullable();
            $table->text('arriveTime')->nullable();
            $table->text('discount')->nullable();
            $table->longText('eticket')->nullable();
            $table->string('contactName')->nullable();
            $table->string('contactPhone')->nullable();
            $table->string('contactEmail')->nullable();
            
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
        Schema::dropIfExists('trans_kereta_passengers');
        Schema::dropIfExists('trans_kereta_bookings');
        Schema::dropIfExists('log_trans_kereta_bookings');
    }
}

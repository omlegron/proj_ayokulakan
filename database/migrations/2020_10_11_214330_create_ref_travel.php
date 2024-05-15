<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefTravel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_travel_lists', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('listID')->nullable();
            $table->string('name')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('ref_travel_routes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('origin')->nullable();
            $table->string('originCity')->nullable();
            $table->string('destination')->nullable();
            $table->string('destinationCity')->nullable();
            $table->string('directionID')->nullable();
            
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
        //
        Schema::dropIfExists('ref_travel_lists');
        Schema::dropIfExists('ref_travel_routes');
    }
}

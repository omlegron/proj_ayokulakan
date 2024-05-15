<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefTour extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_tour_categories', function (Blueprint $table) {
            $table->increments('id');

            $table->string('refID')->nullable();
            $table->string('Category')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('ref_tour_types', function (Blueprint $table) {
            $table->increments('id');

            $table->string('refID')->nullable();
            $table->string('Type')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('ref_tour_provinces', function (Blueprint $table) {
            $table->increments('id');

            $table->string('refID')->nullable();
            $table->string('Province')->nullable();

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
        Schema::dropIfExists('ref_tour_categories');
        Schema::dropIfExists('ref_tour_types');
        Schema::dropIfExists('ref_tour_provinces');
    }
}

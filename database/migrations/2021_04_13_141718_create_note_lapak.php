<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoteLapak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_note_lapak', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lapak_id')->unsigned();
            $table->string('judul_catatan')->nullable();
            $table->longText('isi_catatan')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('trans_kebijakan_lapak', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lapak_id')->unsigned();
            $table->string('judul_kebijakan')->nullable();
            $table->longText('isi_kebijakan')->nullable();

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
        Schema::dropIfExists('trans_note_lapak');
        Schema::dropIfExists('trans_kebijakan_lapak');
    }
}

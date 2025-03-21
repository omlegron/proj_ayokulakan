<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrteateKontakKamiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontak_kami', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama')->nullable();
            $table->string('email')->nullable();
            $table->string('subject')->nullable();
            $table->string('telphone')->nullable();
            $table->string('saran')->nullable();
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
        Schema::dropIfExists('kontak_kami');
    }
}

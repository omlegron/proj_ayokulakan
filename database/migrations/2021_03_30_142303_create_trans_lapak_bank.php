<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransLapakBank extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_lapak_bank', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lapak_id')->unsigned();
            $table->string('nama_ktp')->nullabele();
            $table->string('nomor_ktp')->nullabele();
            $table->string('foto_ktp')->nullabele();
            $table->string('swa_foto')->nullabele();
            $table->string('nama_rekening')->nullabele();
            $table->string('nomor_rekening')->nullabele();
            $table->string('bank')->nullabele();
            $table->string('foto_tabungan')->nullabele();

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
        Schema::dropIfExists('trans_lapak_bank');
    }
}

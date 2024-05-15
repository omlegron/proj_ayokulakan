<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProfileUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_user_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->bigInteger('id_negara')->nullable();
            $table->bigInteger('id_provinsi')->nullable();
            $table->bigInteger('id_kota')->nullable();
            $table->bigInteger('id_kecamatan')->nullable();
            $table->bigInteger('kode_pos')->nullable();
            $table->bigInteger('hp')->nullable();
            $table->longText('alamat')->nullable();
            $table->string('status')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
            // $table->foreign('created_by')->references('id')->on('sys_users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('trans_lapak_barang', function (Blueprint $table) {
            $table->string('status_halal')->nullable();
        });
        Schema::table('log_trans_lapak_barang', function (Blueprint $table) {
            $table->string('status_halal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_trans_lapak_barang', function (Blueprint $table) {
            $table->dropColumn(['status_halal']);
        });

        Schema::table('trans_lapak_barang', function (Blueprint $table) {
            $table->dropColumn(['status_halal']);
        });
        
        Schema::dropIfExists('sys_user_profiles');
    }
}

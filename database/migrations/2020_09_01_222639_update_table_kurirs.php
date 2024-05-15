<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableKurirs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_trans_kurir', function (Blueprint $table) {
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
        });

        Schema::table('trans_kurir', function (Blueprint $table) {
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_trans_kurir', function (Blueprint $table) {
            $table->dropColumn(['lat']);
            $table->dropColumn(['lng']);
        });

        Schema::table('trans_kurir', function (Blueprint $table) {
            $table->dropColumn(['lat']);
            $table->dropColumn(['lng']);
        });
    }
}

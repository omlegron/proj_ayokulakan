<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVerivOnLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_trans_kurir', function (Blueprint $table) {
            $table->string('verived')->after('lng')->nullable();
        });
        Schema::table('log_trans_kaki_lima', function (Blueprint $table) {
            $table->string('subject_verif')->after('kode_pos')->nullable();
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
            $table->dropColumn('verived');
        });
        Schema::table('log_trans_kaki_lima', function (Blueprint $table) {
            $table->dropColumn('subject_verif');
        });
    }
}

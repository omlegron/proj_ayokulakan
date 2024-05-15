<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVerivedOnTransKakiLima extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_kaki_lima', function (Blueprint $table) {
            $table->string('subject_verif')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trans_kaki_lima', function (Blueprint $table) {
            $table->dropColumn('subject_verif');
        });
    }
}

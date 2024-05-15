<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAlamatOnSysUsersCreditCard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_users_credit_card', function (Blueprint $table) {
            $table->string('nama')->after('status')->nullable();
            $table->string('alamat')->after('cvv')->nullable();
            $table->string('kode_pos')->after('alamat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_users_credit_card', function (Blueprint $table) {
            $table->dropColumn('nama');
            $table->dropColumn('alamat');
            $table->dropColumn('kode_pos');
        });
    }
}

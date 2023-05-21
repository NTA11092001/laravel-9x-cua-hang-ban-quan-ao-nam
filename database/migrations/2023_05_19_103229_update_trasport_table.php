<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transports', function (Blueprint $table) {
            $table->renameColumn('cart_id','member_id');
            $table->string('email')->after('phone');
            $table->dropColumn('start_date','end_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transports', function (Blueprint $table) {
            //
        });
    }
};

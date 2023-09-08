<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_details', function (Blueprint $table) {
            $table->dropColumn('menu_id');
            $table->dropColumn('customer_name');
            $table->dropColumn('currency');
            $table->integer('customer_id')->after('id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_details', function (Blueprint $table) {
            $table->dropColumn('customer_id');
            $table->integer('menu_id')->after('id');
            $table->string('customer_name')->after('menu_id');
            $table->string('currency')->after('cuisines_name');

        });
    }
};

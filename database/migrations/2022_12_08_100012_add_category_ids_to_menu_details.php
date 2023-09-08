<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryIdsToMenuDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_details', function (Blueprint $table) {
            $table->dropColumn('category_tag');
            $table->string('category_ids')->after('menu_item_name')->nullable();
            $table->integer('cuisines_order')->after('cuisines_name')->nullable();

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
            $table->dropColumn('category_ids');
            $table->dropColumn('cuisines_order')->nullable();
            $table->string('category_tag')->after('menu_item_name')->nullable();
        });
    }
}

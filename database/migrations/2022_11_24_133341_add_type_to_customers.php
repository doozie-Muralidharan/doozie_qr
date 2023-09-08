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
        Schema::table('customers', function (Blueprint $table) {
            $table->enum('type',['restaurant','caterer'])->after('id')->default('restaurant');
            $table->enum('link_type',['menu','external'])->after('website')->default('menu');
            $table->string('external_link')->after('link_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('link_type');
            $table->dropColumn('external_link');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColunnsInCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('contact_type');
            $table->dropColumn('contact_type_value');
            $table->dropColumn('link_type');
            $table->dropColumn('external_link');
            $table->renameColumn('restaurant_name', 'company_name');
            $table->string('email')->after('restaurant_name');
            $table->string('gst_number')->after('email');
            $table->integer('package_id')->after('gst_number');
            $table->text('address')->after('package_id');
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
            $table->string('type')->after('id');
            $table->string('contact_type')->after('type');
            $table->string('contact_type_value')->after('contact_type');
            $table->string('link_type')->after('contact_type_value');
            $table->string('external_link')->after('link_type');

            // Rename column back to original name
            $table->renameColumn('company_name', 'restaurant_name');

            // Remove the columns added in the up method
            $table->dropColumn('email');
            $table->dropColumn('gst_number');
            $table->dropColumn('package_id');
            $table->dropColumn('address');
        });
    }
}

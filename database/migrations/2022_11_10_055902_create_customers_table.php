<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('restaurant_name');
            $table->string('display_name');
            $table->string('webpage_name');
            $table->string('logo_path');
            $table->string('contact_no_for_webpage');
            $table->string('contact_no')->nullable();
            $table->string('website')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}

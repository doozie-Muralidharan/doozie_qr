<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQrDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qr_details', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('qr_path')->nullable();
            $table->string('bg_color')->nullable();
            $table->string('body_color')->nullable();
            $table->string('eye1_color')->nullable();
            $table->string('eye2_color')->nullable();
            $table->string('eye3_color')->nullable();
            $table->string('eye_ball1_color')->nullable();
            $table->string('eye_ball2_color')->nullable();
            $table->string('eye_ball3_color')->nullable();
            $table->string('gradient_color1')->nullable();
            $table->string('gradient_color2')->nullable();
            $table->string('gradient_type')->nullable();
            $table->string('gradient_on_eyes')->nullable();
            $table->string('body')->nullable();
            $table->string('eye')->nullable();
            $table->string('eye_ball')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_mode')->nullable();
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
        Schema::dropIfExists('qr_details');
    }
}

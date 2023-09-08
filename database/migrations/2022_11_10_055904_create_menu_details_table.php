<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_details', function (Blueprint $table) {
            $table->id();
            $table->integer('menu_id')->nullable();
            $table->string('currency');
            $table->string('menu_priority');
            $table->string('menu_item_name');
            $table->string('catgory_tag');
            $table->string('image_thumbnail')->nullable();
            $table->string('large_image_to_display')->nullable();
            $table->string('video_url')->nullable();
            $table->text('short_description');
            $table->binary('detailed_description');
            $table->integer('cost_in_inr')->nullable();
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
        Schema::dropIfExists('menu_details');
    }
}

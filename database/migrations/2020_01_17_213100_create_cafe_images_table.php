<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCafeImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cafe_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cafe_id')->unsigned()->index();
            $table->string('image');
            $table->timestamps();
            
            // 外部キー制約
            $table->foreign('cafe_id')->references('id')->on('cafes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cafe_images');
    }
}

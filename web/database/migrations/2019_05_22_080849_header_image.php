<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HeaderImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('header_image', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('post_id');
            $table->string('name');
            $table->string('size');
            $table->string('type');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

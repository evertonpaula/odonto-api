<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'user_image', function( $table ){
            $table->bigIncrements('id')->unsigned();
            $table->integer('width');
            $table->integer('height');
            $table->bigInteger('user_id')->unsigned();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('user')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');

            $table->unique('user_id');
        });

        Schema::create( 'user_file', function( $table ){
            $table->bigInteger('image_id')->unsigned();
            $table->string('name');
            $table->string('uuid');
            $table->string('type');
            $table->integer('size');
            $table->string('path');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('image_id')
                  ->references('id')
                  ->on('user_image')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');

            $table->primary('image_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_image');
        Schema::drop('user_file');
    }
}

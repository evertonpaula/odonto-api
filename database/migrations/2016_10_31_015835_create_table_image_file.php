<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableImageFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'file', function( $table ){
            $table->bigIncrements('id')->unsigned();
            $table->string('name');
            $table->string('uuid');
            $table->string('type');
            $table->integer('size');
            $table->string('path');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create( 'image', function( $table ){
            $table->bigIncrements('id')->unsigned();
            $table->integer('width');
            $table->integer('height');
            $table->bigInteger('file_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('file_id')
                  ->references('id')
                  ->on('file')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('image');
        Schema::drop('file');
    }
}

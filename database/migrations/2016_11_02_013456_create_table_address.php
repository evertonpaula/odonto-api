<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'address_type', function( $table ) {
            $table->increments('id')->unsigned();
            $table->string('name')->nullable()->default(null);
            $table->string('slug')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('address', function( $table ) {
            $table->bigIncrements('id')->unsigned();
            $table->string('address')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('zipcode')->nullable()->default(null);
            $table->integer('country_id')->unsigned()->nullable()->default(30);
            $table->string('latitude')->nullable()->default(null);
            $table->string('longitude')->nullable()->default(null);
            $table->integer('address_type_id')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('address_type_id')
                  ->references('id')
                  ->on('address_type')
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
        Schema::drop('address');
        Schema::drop('address_type');
    }
}

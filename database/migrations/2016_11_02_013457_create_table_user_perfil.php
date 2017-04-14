<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserPerfil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'user_perfil', function( $table ){
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('image_id')->unsigned()->nullable()->default(null);;
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone')->nullable()->default(null);
            $table->bigInteger('address_id')->unsigned()->nullable()->default(null);;
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('user')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');

            $table->foreign('image_id')
                  ->references('id')
                  ->on('image')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');

            $table->foreign('address_id')
                  ->references('id')
                  ->on('address')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');

            $table->primary('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_perfil');
    }
}

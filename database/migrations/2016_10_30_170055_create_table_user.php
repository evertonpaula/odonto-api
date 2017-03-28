<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'user', function( $table ){
			$table->bigIncrements('id')->unsigned();
            $table->string('name');
            $table->string('email')->unique();
			$table->string('password');
            $table->string('phone')->nullable()->default(null);
			$table->uuid('uuid');
            $table->timestamp('activated')->nullable()->default(null);
            $table->boolean('locked')->default(true);
            $table->timestamps();
            $table->softDeletes();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user');
    }
}

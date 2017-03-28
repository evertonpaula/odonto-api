<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCountry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'country', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('iso_alpha2', 2);
			$table->string('iso_alpha3', 3);
			$table->integer('iso_numeric');
			$table->char('currency_code', 3);
			$table->string('currency_name', 32);
			$table->string('currrency_symbol', 3);
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('country');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRoomsTable.
 */
class CreateRoomsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rooms', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('num_bed');
            $table->double('price');
            $table->unsignedInteger('home_id');
            $table->foreign('home_id')->references('id')->on('homes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rooms');
	}
}

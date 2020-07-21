<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEntityMediaTable.
 */
class CreateEntityMediaTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entity_media', function(Blueprint $table) {
            $table->tinyInteger('entity_type');
            $table->integer('entity_id');
            $table->integer('media_type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('entity_media');
	}
}

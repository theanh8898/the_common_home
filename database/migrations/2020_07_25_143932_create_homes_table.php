<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homes', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('type_home');
            $table->string('name');
            $table->string('address');
            $table->string('introduction');
            $table->string('links');
            $table->string('amenities');
            $table->string('policies');
            $table->string('detail_description');
            $table->double('lat');
            $table->double('lng');
            $table->unsignedInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->integer('created_at');
            $table->integer('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homes');
    }
}

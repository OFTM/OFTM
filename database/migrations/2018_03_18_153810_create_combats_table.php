<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('participant1_id')->unsigned();
            $table->integer('participant2_id')->unsigned();
            $table->integer('tournament_id')->unsigned();
            $table->integer('referee_id')->unsigned()->nullable();
            $table->integer('hits1')->nullable();
            $table->integer('hits2')->nullable();
            $table->timestamp('timestamp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('combats');
    }
}

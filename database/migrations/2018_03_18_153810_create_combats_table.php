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
            $table->integer('participant1')->unsigned();
            $table->integer('participant2')->unsigned();
            $table->integer('tournament')->unsigned();
            $table->integer('referee')->unsigned();
            $table->integer('hits1');
            $table->integer('hits2');
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeyCombatParticipant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('combats', function (Blueprint $table) {
            $table->foreign('participant1')->references('id')->on('participants');
            $table->foreign('participant2')->references('id')->on('participants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('combats', function (Blueprint $table) {
            $table->dropForeign('combats_participant1_foreign');
            $table->dropForeign('combats_participant2_foreign');
        });
    }
}

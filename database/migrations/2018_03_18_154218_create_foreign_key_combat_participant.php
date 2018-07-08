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
            $table->foreign('participant1_id')->references('id')->on('participants');
            $table->foreign('participant2_id')->references('id')->on('participants');
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
            $table->dropForeign('combats_participant1_id_foreign');
            $table->dropForeign('combats_participant2_id_foreign');
        });
    }
}

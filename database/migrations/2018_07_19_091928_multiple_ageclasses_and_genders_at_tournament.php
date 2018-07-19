<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MultipleAgeclassesAndGendersAtTournament extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropForeign('tournaments_ageclass_id_foreign');
        });

        Schema::create('tournaments_ageclasses', function (Blueprint $table) {
           $table->integer('ageclass_id')->unsigned();
           $table->integer('tournament_id')->unsigned();
        });

        Schema::table('tournaments_ageclasses', function (Blueprint $table) {
            $table->foreign('ageclass_id')->references('id')->on('ageclasses');
        });

        Schema::table('tournaments_ageclasses', function (Blueprint $table) {
            $table->foreign('tournament_id')->references('id')->on('tournaments');
        });

        $results = DB::table('tournaments')->get();

        foreach ($results as $result) {
            DB::table('tournaments_ageclasses')->insert([
                "ageclass_id" => $result->ageclass_id,
                "tournament_id" => $result->id
            ]);
        }

        Schema::table('tournaments', function (Blueprint $table) {
           $table->dropColumn('ageclass_id');
        });

        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropForeign('tournaments_sex_id_foreign');
        });

        Schema::create('tournaments_sexes', function (Blueprint $table) {
            $table->integer('sex_id')->unsigned();
            $table->integer('tournament_id')->unsigned();
        });

        Schema::table('tournaments_sexes', function (Blueprint $table) {
            $table->foreign('sex_id')->references('id')->on('sexes');
        });

        Schema::table('tournaments_sexes', function (Blueprint $table) {
            $table->foreign('tournament_id')->references('id')->on('tournaments');
        });

        $results = DB::table('tournaments')->get();

        foreach ($results as $result) {
            DB::table('tournaments_sexes')->insert([
                "sex_id" => $result->sex_id,
                "tournament_id" => $result->id
            ]);
        }

        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropColumn('sex_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

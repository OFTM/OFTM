<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeyIdFencer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ids', function (Blueprint $table) {
            $table->foreign('fencer')->references('id')->on('fencers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ids', function (Blueprint $table) {
            $table->dropForeign('ids_fencer_foreign');
        });
    }
}

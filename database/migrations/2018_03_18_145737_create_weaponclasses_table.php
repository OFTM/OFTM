<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeaponclassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weaponclasses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('weaponclasses')->insert(
            array(
                'name' => 'Degen'
            )
        );

        DB::table('weaponclasses')->insert(
            array(
                'name' => 'Florett'
            )
        );

        DB::table('weaponclasses')->insert(
            array(
                'name' => 'Säbel'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weaponclasses');
    }
}

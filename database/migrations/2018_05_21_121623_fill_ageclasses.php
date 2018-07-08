<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillAgeclasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('ageclasses')->insert(
            array(
                'name' => 'Schüler',
                'min' => 9,
                'max' => 11
            )
        );

        DB::table('ageclasses')->insert(
            array(
                'name' => 'B-Jugend',
                'min' => 12,
                'max' => 13
            )
        );

        DB::table('ageclasses')->insert(
            array(
                'name' => 'A-Jugend',
                'min' => 14,
                'max' => 16
            )
        );

        DB::table('ageclasses')->insert(
            array(
                'name' => 'Junioren',
                'min' => 17,
                'max' => 19
            )
        );

        DB::table('ageclasses')->insert(
            array(
                'name' => 'Aktive',
                'min' => 20,
                'max' => 99
            )
        );

        DB::table('ageclasses')->insert(
            array(
                'name' => 'Senioren',
                'min' => 40,
                'max' => 99
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
    }
}

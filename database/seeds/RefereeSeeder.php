<?php

use Illuminate\Database\Seeder;

class RefereeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\referee::class, 1)->create();
    }
}

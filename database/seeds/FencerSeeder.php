<?php

use Illuminate\Database\Seeder;

class FencerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\fencer::class, 50)->create();
    }
}

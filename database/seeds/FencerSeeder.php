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
        App\sex::create(['name' => 'male']);
        App\sex::create(['name' => 'female']);
        factory(\App\fencer::class, 10)->create();
    }
}

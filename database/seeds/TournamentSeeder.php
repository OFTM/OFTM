<?php

use Illuminate\Database\Seeder;

class TournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\tournament::class, 10)->create();
        for ($i = 1; $i <= 200; $i++) {
            $f = \App\fencer::all()->random(1)->first->get();
            $t = \App\tournament::all()->random(1)->first->get();
            $p = new \App\participant();
            $p->fencer()->associate($f);
            $p->tournament()->associate($t);
            $p->save();
        }
        factory(\App\combat::class, 50)->create();
    }
}

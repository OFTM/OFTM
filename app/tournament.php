<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tournament extends Model
{
    public function ruleset() {
        return $this->belongsTo('App\ruleset', 'ruleset_id');
    }

    public function sexes() {
        return $this->belongsToMany('App\sex', 'tournaments_sexes', 'tournament_id', 'sex_id');
    }

    public function ageclasses() {
        return $this->belongsToMany('App\ageclass', 'tournaments_ageclasses', 'tournament_id', 'ageclass_id');
    }

    public function weaponclass() {
        return $this->belongsTo('App\weaponclass', 'weaponclass_id');
    }

    public function participants() {
        return $this->hasMany('App\participant', 'tournament_id');
    }

    public function combats() {
        return $this->hasMany('App\combat', 'tournament_id');
    }
}

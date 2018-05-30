<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tournament extends Model
{
    public function ruleset() {
        return $this->belongsTo('App\ruleset', 'ruleset_id');
    }

    public function sex() {
        return $this->belongsTo('App\sex', 'sex_id');
    }

    public function ageclass() {
        return $this->belongsTo('App\ageclass', 'ageclass_id');
    }

    public function weaponclass() {
        return $this->belongsTo('App\weaponclass', 'weaponclass_id');
    }
}

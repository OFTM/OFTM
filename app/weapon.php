<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class weapon extends Model
{
    public function weaponclass() {
        return $this->belongsTo('App\weaponclass', 'weaponclass_id');
    }

    public function fencer() {
        return $this->belongsTo('App\fencer', 'fencer_id');
    }
}

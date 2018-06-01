<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class participant extends Model
{
    public function fencer() {
        return $this->belongsTo('App\fencer', 'fencer_id');
    }

    public function tournament() {
        return $this->belongsTo('App\tournament', 'tournament_id');
    }
}

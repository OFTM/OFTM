<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class combat extends Model
{
    public function participant1() {
        return $this->belongsTo('App\participant', 'participant1_id');
    }

    public function participant2() {
        return $this->belongsTo('App\participant', 'participant2_id');
    }

    public function tournament() {
        return $this->belongsTo('App\tournament', 'tournament_id');
    }

    public function referee() {
        return $this->belongsTo('App\referee', 'referee_id');
    }
}

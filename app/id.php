<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class id extends Model
{
    public function fencer() {
        return $this->belongsTo('App\fencer', 'fencer_id');
    }

    public function type() {
        return $this->belongsTo('App\id_type', 'type_id');
    }
}

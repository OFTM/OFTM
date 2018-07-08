<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class referee extends Model
{
    public function person() {
        return $this->belongsTo('App\people', 'people_id');
    }
}

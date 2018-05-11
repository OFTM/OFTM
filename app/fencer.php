<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fencer extends Model
{
    protected $hidden = array('created_at', 'updated_at', 'people_id');

    public function person() {
        return $this->belongsTo('App\people', 'people_id');
    }

    public function weapons() {
        return $this->hasMany('App\weapon', 'fencer_id');
    }
}

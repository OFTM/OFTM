<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class people extends Model
{
    protected $fillable = array('forename', 'surname', 'birthdate');
    protected $hidden = array('created_at', 'updated_at', 'sex_id');

    public function sex()
    {
        return $this->belongsTo('App\sex', 'sex_id');
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'birthdate'
    ];

}

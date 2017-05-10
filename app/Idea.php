<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function jobs() {

        return $this->belongsToMany('App\Job')->withTimestamps();

    }
}

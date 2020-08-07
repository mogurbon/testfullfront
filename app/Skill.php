<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    /*public function employee()
    {
        return $this->belongsTo('App\Employee');
    }*/


    public function employee()
    {
        return $this->belongsToMany('App\Employee');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClearanceStage extends Model
{
    protected $guarded = ['id'];

    public function requirements(){
        return $this->hasMany('App\Requirement');
    }

    public function clearance(){
        return $this->hasMany('App\Clearance');
    }

    public function stage_requirements(){
        return $this->belongsToMany('App\Requirement');
    }
}

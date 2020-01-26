<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = ['id'];

    public function prospect(){
        return $this->belongsTo('App\Prospect', 'matric');
    }

    public function clearance(){
        return $this->hasmany('App\Clearance', 'matric');
    }
}

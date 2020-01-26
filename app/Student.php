<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['id'];

    public function prospect(){
        return $this->belongsTo('App\Prospect', 'matric');
    }

    public function clearance(){
        return $this->hasMany('App\Clearance');
    }
}

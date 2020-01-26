<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clearance extends Model
{
    protected $guarded = ['id'];

    public function requirement(){
        return $this->belongsTo('App\Requirement');
    }
    
    public function student(){
        return $this->belongsTo('App\Student');
    }

}

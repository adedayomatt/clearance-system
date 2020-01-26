<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    protected $primaryKey = 'matric';
    protected $incrementing = false;
    protected $guarded = [];
    
    public function student(){
        return $this->hasOne('App\Student');
    }
}

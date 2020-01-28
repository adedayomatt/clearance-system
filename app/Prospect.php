<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'matric';
    protected $guarded = [];
    protected $appends = ['fullname'];
    
    public function student(){
        return $this->hasOne('App\Student');
    }

    public function getFulnameAttribute(){
        return strtoupper($this->last_name).', '.$this->first_name.' '.$this->other_name; 
    }

    public function clearance_registered(){
        return $this->student == null ? false : true;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'matric';
    protected $guarded = [];
    protected $appends = ['fullname', 'clearance_status'];
    
    public function student(){
        return $this->hasOne('App\Student', 'matric');
    }

    public function getFullnameAttribute(){
        return strtoupper($this->last_name).', '.$this->first_name.' '.$this->other_name; 
    }

    public function clearance_registered(){
        return $this->student == null ? false : true;
    }

    public function getClearanceStatus(){

    } 
}

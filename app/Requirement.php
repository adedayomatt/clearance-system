<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $guarded = ['id'];

    public function clearance_stage(){
        return $this->belongsTo('App\ClearanceStage');
    }

    public function clearance_stages(){
        return $this->belongsToMany('App\ClearanceStage');
    }

    public function clearances(){
        return $this->hasMany('App\Clearance');
    }

    public function student_clearance($student_id){
        $clearance = $this->clearances()->where('student_id', $student_id)->first();
        return $clearance == null ? false : $clearance;
    }
}

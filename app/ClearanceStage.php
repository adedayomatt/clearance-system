<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClearanceStage extends Model
{
    protected $guarded = ['id'];

    public function requirements(){
        return $this->hasMany('App\Requirement');
    }


    public function stage_requirements(){
        return $this->belongsToMany('App\Requirement');
    }

    public function clearances($student_id = null){
        $clearances = collect([]);
        foreach ($this->requirements as $requirement) {
            if($student_id == null){
                $clearances = $clearances->merge($requirement->clearances);
            }else{
                $clearances = $clearances->merge($requirement->clearances()->where('student_id', $student_id)->get());
            }
        }
        return $clearances;
    }


    public function submission_progress($student_id){
        $requirements = $this->requirements->count();
        $submited = $this->clearances($student_id)->count();
        return ($submited/$requirements)*100;
    }

    public function approval_progress($student_id){
        $requirements = $this->requirements->count();
        $approved = 0;
        foreach($this->clearances($student_id) as $clearance){
            if($clearance->approved()){
                $approved++;
            }
        }
        return ($approved/$requirements)*100;
    }

    public function submissions(){
        $pending = collect([]);
        $approved = \collect([]);
        $rejected = \collect([]);
        foreach($this->clearances() as $clearance){
            if($clearance->approved()){
                $approved->push($clearance);
            }else if($clearance->rejected()){
                $rejected->push($clearance);
            }else{
                $pending->push($clearance);
            }
        }
        return ['pending' => $pending, 'approved' => $approved, 'rejected' => $rejected];
    }
}

<?php

namespace App;

use DB;
use App\ClearanceStage;
use Illuminate\Database\Eloquent\Model;

class ClearanceStage extends Model
{
    protected $guarded = ['id'];

    public function requirements(){
        return $this->hasMany('App\Requirement');
    }

    public function stage_requirements(){
        $secondary = DB::table('clearance_stage_requirement')->where('secondary_stage_id', $this->id)->pluck('primary_stage_id')->toArray();
        return ClearanceStage::whereIn('id', $secondary)->get();
    }

    public function attach_stages($stages = []){
        DB::table('clearance_stage_requirement')->where('secondary_stage_id', $this->id)->delete();
       if($stages){
            foreach ($stages as $stage) {
                DB::table('clearance_stage_requirement')->insert([
                    'primary_stage_id' => $stage,
                    'secondary_stage_id' => $this->id
                ]);
            }
       }
    }

    public function primary_stage(){
        $primary = [];
        foreach ($this->stage_requirements() as $stage) {
            array_push($primary, $stage->id);
        }
        return $primary;
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

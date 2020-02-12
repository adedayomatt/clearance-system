<?php

namespace App;

use App\Form;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['type', 'form'];

    public function clearance_stage(){
        return $this->belongsTo('App\ClearanceStage');
    }

    public function clearance_stages(){
        return $this->belongsToMany('App\ClearanceStage');
    }

    public function clearances(){
        return $this->hasMany('App\Clearance');
    }

    public function getTypeAttribute(){
        if($this->file_upload && $this->form_id == null){
            return 'upload';
        }
        elseif(!$this->file_upload && $this->form_id != null){
            return 'form';
        }
    }

    public function getFormAttribute(){
        return Form::find($this->form_id);
    }

    public function student_clearance($student_id){
        $clearance = $this->clearances()->where('student_id', $student_id)->first();
        return $clearance == null ? false : $clearance;
    }
}

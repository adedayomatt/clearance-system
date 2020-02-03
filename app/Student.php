<?php

namespace App;

use App\Requirement;
use App\ClearanceStage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['id'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['clearance_progress', 'clearance_approval_progress', 'avatar'];

    public function prospect(){
        return $this->belongsTo('App\Prospect', 'matric');
    }

    public function clearances(){
        return $this->hasMany('App\Clearance');
    }

    public function fufillRequirement($requirement_id){
        return $this->clearances()->where('requirement_id', $requirement_id)->first() == null ? false : true;
    }

    public function getClearanceProgressAttribute(){
        $requirements = Requirement::all()->count();
        $clearances = $this->clearances()->count();

        return ($clearances/$requirements)*100;
    }

    public function getClearanceApprovalProgressAttribute(){
        $requirements = Requirement::all()->count();
        $approved_clearances = $this->clearances()->where('approved_at', '!=', null)->count();

        return ($approved_clearances/$requirements)*100;
    }

    public function getAvatarAttribute(){
        return asset('storage/students/'.$this->passport);
    }
}

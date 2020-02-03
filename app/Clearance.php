<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clearance extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['approved_at','rejected_at'];

    public function requirement(){
        return $this->belongsTo('App\Requirement');
    }
    
    public function student(){
        return $this->belongsTo('App\Student');
    }

    public function approved(){
        return $this->approved_at == null ? false : true;
    }

    public function rejected(){
        return $this->rejected_at == null ? false : true;
    }

    public function getUploadedFileAttribute(){
        return asset('storage/clearance/'.$this->upload);
    }

}

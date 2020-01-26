<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirements extends Model
{
    protected $guarded = ['id'];

    public function clearance_stage(){
        return $this->belongsTo('App\ClearanceStage');
    }
    
}

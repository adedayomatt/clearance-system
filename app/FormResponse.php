<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormResponse extends Model
{
    protected $guarded = ['id'];

    public function form_field(){
        return $this->belongsTo('App\FormField');
    }

    public function student(){
        return $this->belongsTo('App\Student');
    }

}

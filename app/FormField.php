<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    public $guarded = ['id'];

    public function form(){
        return $this->belongsTo('App\Form');
    }

    public function form_responses(){
        return $this->hasMany('App\FormResponse');
    }
}

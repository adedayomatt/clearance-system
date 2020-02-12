<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormInput extends Model
{
    public $guarded = ['id'];

    public function form_field(){
        return $this->belongsTo('App\FormField', 'form_field_id');
    }
}

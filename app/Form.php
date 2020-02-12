<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    public $guarded = ['id'];

    public function form_fields(){
        return $this->hasMany('App\FormField');
    }
}

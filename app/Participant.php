<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    public function QuizAnswer(){
        return $this->hasMany('App\QuizAnswer');
    }
}

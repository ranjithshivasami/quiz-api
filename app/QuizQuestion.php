<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable = ['created_at', 'updated_at'];
    function quizAnswer(){
        return $this->hasMany('App\QuizAnswer');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    public function quizQuestion(){
        return $this->belongsTo('App\QuizQuestion');
    }

    public function participant(){
        return $this->belongsTo('App\Participant');
    }
    
}

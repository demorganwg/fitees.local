<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function assignment() {
        return $this->belongsTo('App\Assignment');
    }

    public function answers() {
        return $this->hasMany('App\Answer');
    }
    
    public static function getQuestionByNumber($assignmentId, $questionNumber) {
		
		return Question::where('assignment_id', $assignmentId)->where('number', $questionNumber)->first();
		
	}
	
    /*public static function getFirstQuestionId ($assignmentId) {
		
		return Question::where('assignment_id', $assignmentId)->where('number', 1)->firstOrFail()->id;
		
	}*/
}

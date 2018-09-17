<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function question() {
        return $this->belongsTo('App\Question');
    }
    
    public static function getQuestionAnswers($questionId) {

		return self::all()->where('question_id', '=', $questionId);
	
	}
}

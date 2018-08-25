<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
	public function pages()
	{
	    return $this->hasMany('App\Page');
	}
	
    public static function getTopicByAlias($topicAlias) {
		
		return Topic::where('alias', $topicAlias)->firstOrFail();
		
	}
	
	public static function getFirstTopicAlias ($courseId) {
		
		return Topic::where('course_id', $courseId)->where('number', 1)->firstOrFail()->alias;
		
	}
	
}

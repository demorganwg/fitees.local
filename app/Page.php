<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function topic()
	{
	    return $this->belongsTo('App\Topic', 'topic_id');
	}
	
	public static function getPageByNumber($topicId, $pageNumber) {
		
		return Page::where('topic_id', $topicId)->where('number', $pageNumber)->firstOrFail();
		
	}
	
	public static function getTopicPages($topic_id) {

		return Page::orderBy('number')->where('topic_id', '=', $topic_id)->get();
	
	}
}

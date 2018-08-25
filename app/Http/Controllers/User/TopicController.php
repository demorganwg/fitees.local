<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;

use App\Course;
use App\Topic;

class TopicController extends SiteController
{
	public function __construct()
    {
		parent::__construct();		
    }
    
    public function showTopic($courseAlias, $topicAlias) {
    	
    	$course = Course::getCourseByAlias($courseAlias);
    	$navbar_topics = $course->topics()->orderBy('number')->get();
    	
    	foreach($navbar_topics as $topic) {
			$topic['pages'] = $topic->pages()->orderBy('number')->get();
		}

		$topicNavigation = view(env('THEME').'.user.topics-navigation', 
							['navbar_topics' => $navbar_topics, 
							'courseAlias' => $courseAlias])
							->render();
    	
		$topic = Topic::getTopicByAlias($topicAlias);
		$topic['pages'] = $topic->pages()->orderBy('number')->get();
		$title = 'Меню курса '.$topic->name;
		$this->vars = array_add($this->vars, 'title', $title);
		$this->vars = array_add($this->vars, 'courseAlias', $courseAlias);
		$this->vars = array_add($this->vars, 'currentTopic', $topic);
    	
    	
		$this->vars = array_add($this->vars, 'topicNavigation', $topicNavigation);
		
		$this->template = env('THEME').'.user.topic';
        return $this->renderOutput();
		
	}
}

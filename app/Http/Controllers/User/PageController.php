<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;

use App\Course;
use App\Topic;
use App\Page;

class PageController extends SiteController
{
    public function __construct()
    {
		parent::__construct();		
    }
    
    public function showPage($courseAlias, $topicAlias, $pageNumber) {
    	
    	$course = Course::getCourseByAlias($courseAlias);
    	$topicId = Topic::getTopicByAlias($topicAlias)->id;
		
    	$navbar_topics = $course->topics()->orderBy('number')->get();
    	
    	foreach($navbar_topics as $topic) {
			$topic['pages'] = $topic->pages()->orderBy('number')->get();
		}

		$topicNavigation = view(env('THEME').'.user.topics-navigation', 
							['navbar_topics' => $navbar_topics, 
							'courseAlias' => $courseAlias])
							->render();
							
    	$page = Page::getPageByNumber($topicId, $pageNumber);
    	$topicPageList = Page::getTopicPages($page->topic_id);
		
    	$pagination['showPrev'] = TRUE;
    	$pagination['showNext'] = TRUE;
    	$pagination['PrevPage'] = $pageNumber - 1;
    	$pagination['NextPage'] = $pageNumber + 1 ;
    	
    	if($pagination['PrevPage'] <= 0) {
			$pagination['showPrev'] = FALSE;
		}
		if($pagination['NextPage'] > $topicPageList->count()) {
			$pagination['showNext'] = FALSE;
		}

    	$title = $page->name;
		$this->vars = array_add($this->vars, 'title', $title);
		$this->vars = array_add($this->vars, 'page', $page);
		$this->vars = array_add($this->vars, 'topicPageList', $topicPageList);
		$this->vars = array_add($this->vars, 'courseAlias', $courseAlias);
		$this->vars = array_add($this->vars, 'pagination', $pagination);
    	
		$this->vars = array_add($this->vars, 'topicNavigation', $topicNavigation);
		
		$this->template = env('THEME').'.user.page';
        return $this->renderOutput();
		
	}
}

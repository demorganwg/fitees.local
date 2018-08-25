<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use Auth;
use App\Course;
use App\Topic;
use App\Question;
use App\Assignment;
use App\UserCourse;
use App\AssignmentResult;
use App\Http\Controllers\SiteController;

class CourseMenuController extends SiteController
{
	
	public function __construct()
    {
		parent::__construct();		
    }
    
    public function runCourse($courseAlias) {
		
		$course = Course::getCourseByAlias($courseAlias);
		$firstTopicAlias = Topic::getFirstTopicAlias($course->id);
		
		$title = $course->name;
		$this->vars = array_add($this->vars, 'title', $title);
		
		return redirect()->route('course.show.topic', ['alias' => $courseAlias, 'topic_alias' => $firstTopicAlias]);
		
	}
	
	public function showMenu($courseAlias) {
		
		$course = Course::getCourseByAlias($courseAlias);
		
		$title = 'Меню курса '.$course->name;
		$this->vars = array_add($this->vars, 'title', $title);
		$this->vars = array_add($this->vars, 'courseAlias', $courseAlias);
		
		$this->template = env('THEME').'.user.course-menu';
        return $this->renderOutput();
		
	}
	
	public function showTopics($courseAlias) {
		
		$course = Course::getCourseByAlias($courseAlias);
		$topics = $course->topics()->orderBy('number')->get();
		
		$title = 'Темы курса '.$course->name;
		$this->vars = array_add($this->vars, 'title', $title);
		$this->vars = array_add($this->vars, 'courseAlias', $courseAlias);
		$this->vars = array_add($this->vars, 'topics', $topics);	
		
		$this->template = env('THEME').'.user.course-topics';
        return $this->renderOutput();
		
	}
	
	public function showAssignments($courseAlias) {
		
		$course = Course::getCourseByAlias($courseAlias);
		$assignments = $course->assignments()->orderBy('number')->get();
		
		$title = 'Задания курса '.$course->name;
		$this->vars = array_add($this->vars, 'title', $title);
		$this->vars = array_add($this->vars, 'courseAlias', $courseAlias);
		$this->vars = array_add($this->vars, 'assignments', $assignments);	
		
		$this->template = env('THEME').'.user.course-assignments';
        return $this->renderOutput();
		
	}
	
	public function showResources($courseAlias) {
		
		$course = Course::getCourseByAlias($courseAlias);
		$resources = $course->resources()->orderBy('number')->get();
		
		$title = 'Материалы курса '.$course->name;
		$this->vars = array_add($this->vars, 'title', $title);
		$this->vars = array_add($this->vars, 'courseAlias', $courseAlias);
		$this->vars = array_add($this->vars, 'resources', $resources);	
		
		$this->template = env('THEME').'.user.course-resources';
        return $this->renderOutput();
		
	}
	
	public function showResults($courseAlias) {
		
		$course = Course::getCourseByAlias($courseAlias);	
		$userCourse = UserCourse::getCourseResults(Auth::user()->id, $course->id);
		$result_list = AssignmentResult::getCourseResults($userCourse->id);

		$title = 'Результаты курса '.$course->name;
		$this->vars = array_add($this->vars, 'title', $title);
		$this->vars = array_add($this->vars, 'courseAlias', $courseAlias);
		
		foreach ($result_list as $result) {
			$result['name'] = $result->assignment->name;
			$result['number'] = $result->assignment->number;
		}
		
		$this->vars = array_add($this->vars, 'result_list', $result_list);
		
		$this->template = env('THEME').'.user.course-results';
        return $this->renderOutput();
		
	}
}

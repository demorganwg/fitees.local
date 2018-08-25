<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;

use Auth;
use App\Course;

class CourseMenuController extends SiteController
{
    
    public function __construct()
    {

		parent::__construct();
		
    }
    
    public function index($courseAlias) {
    	
    	$course = Course::getCourseByAlias($courseAlias);
		
		$title = $course;
    	$this->vars = array_add($this->vars, 'title', $title);
    	
    	
    	
    	$this->template = env('THEME').'.teacher.course';
    	return $this->renderOutput();
		
	}
    
    public function addCourse(Request $request) {
		
		if($request->isMethod('post')){
			
			$result = $request->except(['_token']);
			
			
			
			if(Course::dataIsAcceptable($result['name'], $result['alias'])) {
				dump('Course exists');
			}
			else {
				dump('Name and Alial is OK');
				$course = new Course;
				$course->name = $request['name'];
				$course->description = $request['description'];
				$course->image = $request['image'];
				$course->info = $request['info'];
				$course->alias = $request['alias'];
				$course->author_id = Auth::user()->id;
				
				if(!$course->save()){
				    App::abort(500, 'Error');
				}
			}
			dd($result);
			
			/*$user = Auth::user();
			$course = Course::getCourseByAlias($courseAlias);
			$assignment = Assignment::getAssignmentByAlias($assignmentAlias);
			
			$userResults = self::calculateResults($assignment, $result);
			self::insertAssignmentsResult($user->id, $course->id, $assignment->id, $result, $userResults['userScore']);*/
			
		}
		/*else {
			App::abort(400, 'Error');
		}*/
			
		/*session(['userResults' => $userResults]);									
											
		return redirect()->route('assignment.show.result', [
												'alias' => $courseAlias,
												'assignment_alias' => $assignmentAlias,
												]);*/
												
												
												
												
												
		$title = 'FITees Добавить курс';
    	$this->vars = array_add($this->vars, 'title', $title);
    	
    	
    	
    	$this->template = env('THEME').'.teacher.course-add';
    	return $this->renderOutput();
		
	}
	
    
    public function editCourse($courseAlias) {
		
		$course = Course::getCourseByAlias($courseAlias);
		
		$title = 'Редактировать курс '.$course->name;
    	$this->vars = array_add($this->vars, 'title', $title);
    	
    	
    	
    	$this->template = env('THEME').'.teacher.course-edit';
    	return $this->renderOutput();
		
	}
}

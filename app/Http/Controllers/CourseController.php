<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course;
use App\UserCourse;
use Auth;

class CourseController extends SiteController
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

		parent::__construct();
		
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function listCourses()
    {
    	$title = 'FITees Все курсы';
    	$this->vars = array_add($this->vars, 'title', $title);
    	
		$course_list = Course::getAllCourses();
    	$this->vars = array_add($this->vars, 'course_list', $course_list);
    	
    	$this->template = env('THEME').'.courses';
    	
        return $this->renderOutput();
    }
    
    public function showCourse($courseAlias)
    {
		$title = 'FITees Курс';
		$this->vars = array_add($this->vars, 'title', $title);
		
		$course = Course::getCourseByAlias($courseAlias);
		$course['author'] = $course->user->name.' '.$course->user->surname;
		$course['topics'] = $course->topics;
		$course['assignments'] = $course->assignments;
		$course['resources'] = $course->resources;
		$course['showApllyForm'] = TRUE;
		$course['showCourseStatus'] = TRUE;
		
		if(Auth::check()){
			
			if(Auth::user()->hasRole('Unknown') || Auth::user()->hasRole('Student')) {
				
				$userCourse = UserCourse::where('user_id', '=', Auth::user()->id)
							->where('course_id', '=', $course->id)->first();
			
				if($userCourse !== NULL) {
					switch($userCourse['status']){
						case 0: 
							$course['status'] = 'Заявка на утверждении';
							break;
						case 1: 
							$course['status'] = 'Курс активен';
							break;
						case 2: 
							$course['status'] = 'Курс пройден';
							break;
						default:
							$course['status'] = 'Что то пошло не так';
					}
					$course['showApllyForm'] = FALSE;
				}
				else {
					$course['showApllyForm'] = TRUE;
				}
			}
			else {
				$course['showApllyForm'] = FALSE;
				$course['showCourseStatus'] = FALSE;
			}
				
		}
		
		$this->vars = array_add($this->vars, 'course', $course);

		$this->template = env('THEME').'.course';
    	
        return $this->renderOutput();
		
	}
	
	public function applyCourse($courseAlias, Request $request) {
		
		if($request->isMethod('post')){
			
			$userCourse = UserCourse::create(['user_id' => Auth::user()->id,
						 'course_id' => Course::getCourseByAlias($courseAlias)->id]);;
		}
		
		return redirect()->route('course.show', ['alias' => $courseAlias]);
		
	}
}

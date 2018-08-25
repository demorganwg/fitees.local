<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Course;
use App\UserCourse;
use App\Http\Controllers\SiteController;

class HomeController extends SiteController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

		parent::__construct();
		
		$this->template = env('THEME').'.learn';
		
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$title = 'FITees Learn';
    	$this->vars = array_add($this->vars, 'title', $title);
    	
    	$userCourses = UserCourse::getUserCourses(Auth::user()->id);
    	foreach ($userCourses as $userCourse) {
			$userCourse['name'] = $userCourse->course->name;
			$userCourse['image'] = $userCourse->course->image;
			$userCourse['alias'] = $userCourse->course->alias;
			$userCourse['showCourseLink'] = FALSE;
			switch($userCourse['status']){
				case 0: 
					$userCourse['statusMessage'] = 'Заявка на утверждении';
					break;
				case 1: 
					$userCourse['statusMessage'] = 'Курс активен';
					$userCourse['showCourseLink'] = TRUE;
					break;
				case 2: 
					$userCourse['statusMessage'] = 'Курс пройден';
					$userCourse['showCourseLink'] = TRUE;
					break;
				default:
					$userCourse['statusMessage'] = 'Что то пошло не так';
			}
		}
							
		$this->vars = array_add($this->vars, 'userCourses', $userCourses);		

	
	
	
        return $this->renderOutput();
    }
}

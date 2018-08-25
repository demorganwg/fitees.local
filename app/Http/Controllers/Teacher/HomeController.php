<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;

use Auth;
use App\Course;

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
		
		$this->template = env('THEME').'.teacher.teach';
		
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	
    	$title = 'FITees Teacher Home';
    	$this->vars = array_add($this->vars, 'title', $title);
    	
    	$author_id = Auth::user()->id;
    	$teacherCourses = Course::getAuthorCourses($author_id);
							
		$this->vars = array_add($this->vars, 'teacherCourses', $teacherCourses);	
        return $this->renderOutput();
        
    }
}

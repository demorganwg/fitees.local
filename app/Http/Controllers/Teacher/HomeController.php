<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;

use DB;
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
		
		$this->template = env('THEME').'.teacher.home';
		
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
    	
        return $this->renderOutput();
    }
}

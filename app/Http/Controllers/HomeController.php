<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

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
		
		$this->template = env('THEME').'.home';
		
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$title = 'FITees Home';
    	$homebar = view(env('THEME').'.homebar')->render();
		$this->vars = array_add($this->vars, 'homebar', $homebar);
    	$this->vars = array_add($this->vars, 'title', $title);
	
        return $this->renderOutput();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends SiteController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

		parent::__construct();
		
		$this->template = env('THEME').'.index';
		
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$title = 'FITees Index';
    	
    	$this->vars = array_add($this->vars, 'title', $title);
    	
        return $this->renderOutput();
    }
}

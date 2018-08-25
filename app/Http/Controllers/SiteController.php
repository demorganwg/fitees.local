<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SiteController extends Controller
{
    
    protected $template;
    
    protected $vars;
    
    /*protected $contentRightBar = FALSE;
    protected $contentLeftBar = FALSE;
    protected $bar = FALSE;*/
    
    
    public function __construct() {	


	}
	
	protected function renderOutput() {
		
		$header = view(env('THEME').'.header')->render();
		
		$this->vars = array_add($this->vars, 'header', $header);
		
		return view($this->template)->with($this->vars);
		
	}
    
}

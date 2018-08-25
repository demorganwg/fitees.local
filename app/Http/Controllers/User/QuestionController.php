<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;

use App\Question;
use App\Answer;
use App\Assignment;
//use Session;

class QuestionController extends SiteController
{
    
	
	 public function storeAnswers(Request $request) {
	 	/*$sessionValue = $request->session()->get('key', 'default');
		dd($request->session());*/
	 }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
	public function questions()
	{
	    return $this->hasMany('App\Question');
	}
	
    public static function getAssignmentByAlias($assignmentAlias) {
		
		return Assignment::where('alias', $assignmentAlias)->firstOrFail();
		
	}
}

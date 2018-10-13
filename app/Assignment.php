<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
	protected $fillable = ['name', 'description', 'number', 'alias', 'course_id'];
	
	public function questions()
	{
	    return $this->hasMany('App\Question');
	}
	
	public function assignmentResults()
	{
	    return $this->hasMany('App\AssignmentResult');
	}
	
    public static function getAssignmentByAlias($assignmentAlias) {
		
		return self::where('alias', $assignmentAlias)->firstOrFail();
		
	}
	
	public static function getCourseAssignments($courseId) {
		
		return self::all()->where('course_id', '=', $courseId);
		
	}
}

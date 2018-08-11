<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
	public function userCourse()
	{
	    return $this->hasMany('App\UserCourse');
	}
	
	public function user()
	{
	    return $this->belongsTo('App\User', 'author_id');
	}
	
	public function topics()
	{
	    return $this->hasMany('App\Topic');
	}
	
	public function assignments()
	{
	    return $this->hasMany('App\Assignment');
	}
	
	public function resources()
	{
	    return $this->hasMany('App\Resource');
	}
	
	public static function getCourseByAlias($courseAlias) {
		
		return Course::where('alias', $courseAlias)->firstOrFail();
		
	}
	
    public static function getAllCourses() {

		return Course::all('name', 'description', 'image', 'alias', 'status')->where('status', '=', 1);
	
	}
	
}

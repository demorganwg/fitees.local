<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
	protected $fillable = ['name', 'description', 'image', 'info', 'status', 'alias', 'author_id'];
	
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
		
		return self::where('alias', $courseAlias)->firstOrFail();
		
	}
	
    public static function getAllCourses() {

		return self::all('name', 'description', 'image', 'alias', 'status')->where('status', '=', 1);
	
	}
	
	public static function getUserCourses($userId) {

		return self::all()->where('user_id', '=', $userId);
	
	}
	
	public static function getAuthorCourses($authorId) {
		
		return self::all()->where('author_id', '=', $authorId);
		
	}
	
	public static function dataIsAcceptable($courseName, $courseAlias) {
		
		/*$courseName = 'Course_name_1';
		$courseAlias = 'course_alias_1';*/
		
//		dd(self::where('name', $courseName)->orWhere('alias', $courseAlias)->first());
		
		if(self::where('name', $courseName)->orWhere('alias', $courseAlias)->first()) {
			return TRUE;
		}
		else {
			return FALSE;
		} 
		
	}
	
}

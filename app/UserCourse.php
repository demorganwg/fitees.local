<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
	protected $table = 'user_courses';
	protected $fillable = ['user_id', 'course_id', 'status', 'score'];
	
    public function user()
	{
	    return $this->belongsTo('App\User', 'user_id');
	}
	
	public function course()
	{
	    return $this->belongsTo('App\Course', 'course_id');
	}
	
	public static function getUserCourses($user_id) {

		return UserCourse::all()->where('user_id', '=', $user_id);
	
	}
	
	public static function getCourseResults($user_id, $course_id) {

		return UserCourse::where('user_id', '=', $user_id)->where('course_id', '=', $course_id)->first();
	
	}
}

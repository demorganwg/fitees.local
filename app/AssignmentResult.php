<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentResult extends Model
{
    protected $table = 'assignment_results';
    protected $fillable = ['score', 'answers', 'user_course_id', 'assignment_id'];
    
    public function user_course()
	{
	    return $this->belongsTo('App\UserCourse', 'user_course_id');
	}
	
	public function assignment()
	{
	    return $this->belongsTo('App\Assignment', 'assignment_id');
	}
	
	public static function getCourseResults($user_course_id) {

		return AssignmentResult::all()->where('user_course_id', '=', $user_course_id);
	
	}
}

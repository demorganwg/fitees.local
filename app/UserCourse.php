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
	    return $this->belongsTo('App\Role', 'course_id');
	}
}

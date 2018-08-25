<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Course;
use App\UserCourse;

class CourseAllowed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	$course = Course::getCourseByAlias($request->route('alias'));
    	$userCourse = UserCourse::getCourseResults(Auth::user()->id, $course->id);
    	
        if($userCourse !== NULL) {
//        	Статус на утверждении
        	if($userCourse['status'] == 1 || $userCourse['status'] == 2) {
//				Статус курса Активен или Пройден
				return $next($request);
			}
		}
		
//		Пользователь не подавал заявку на курс (нет в таблице user_courses)
		abort(404);

    }
}

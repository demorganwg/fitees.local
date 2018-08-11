<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Student
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
		/*echo "Middleware 'Student'";
		dump("Middleware 'Student'");*/
		
    	if(Auth::check() && Auth::user()->hasRole('Student')) {
    		return $next($request);
		}
		
   		abort(404);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\SiteController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends SiteController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    
    protected function redirectTo()
	{
		if (\Auth::user()->hasRole('Unknown')) {
        	return route('home');
   		}
		if (\Auth::user()->hasRole('Student')) {
        	return route('home');
   		}
   		if (\Auth::user()->hasRole('Teacher')) {
        	return route('teacher');
   		}
   		if (\Auth::user()->hasRole('Admin')) {
        	return route('admin');
   		}
	    return '/';
	}

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        parent::__construct();
    	
        $this->middleware('guest')->except('logout');
		
		$this->template = env('THEME').'.auth.login';
		
    }
}

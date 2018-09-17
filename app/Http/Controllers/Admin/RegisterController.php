<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends SiteController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';
    
    /*protected function redirectTo()
	{
		if (\Auth::user()->hasRole('Unknown')) {
        	return route('home');
   		}
	    return '/';
	}*/

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	parent::__construct();
    	
        $this->middleware('admin');
		
		$this->template = env('THEME').'.admin.register-teacher';
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'min:6|same:password',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'role_id' => 3,
            'group_id' => 2,
            'password' => Hash::make($data['password']),
        ]);
    }
}

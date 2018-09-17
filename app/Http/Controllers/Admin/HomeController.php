<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;

use App\Course;
use App\User;
use App\Group;

class HomeController extends SiteController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

		parent::__construct();
		
		$this->template = env('THEME').'.admin.home';
		
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	
    	$title = 'FITees Admin Home';
    	$this->vars = array_add($this->vars, 'title', $title);
    	
    	$coursesNotActive = Course::getAllNotActiveCourses();
    	$coursesActive = Course::getAllCourses();
    	$unknownUsers = User::getAllUnknownUsers()->values();
    	$teachers = User::getAllTeachers()->values();
    	$groups = Group::getGroups()->values();
    	
    	foreach($unknownUsers as $user) {
			$user['group'] = $user->group->name;
		}
    	
    	$this->vars = array_add($this->vars, 'users', $unknownUsers);
    	$this->vars = array_add($this->vars, 'groups', $groups);
    	$this->vars = array_add($this->vars, 'teachers', $teachers);
    	$this->vars = array_add($this->vars, 'coursesNotActive', $coursesNotActive);
    	$this->vars = array_add($this->vars, 'coursesActive', $coursesActive);
        return $this->renderOutput();
        
    }
    
    public function verifyUsers(Request $request)
    {
    	$records = $request->except(['_token', 'check-all']);
    	$usersIdToUpdate = $usersIdToDelete = array();
    	
    	foreach($records as $key => $record) {
			if(preg_match("#^verify-(.*)$#i", $key)) {
				
				if (($pos = strpos($key, "-")) !== FALSE) { 
				    $userId = substr($key, $pos+1); 
				}
				else {
					$userId = NULL;
				}
	
				$userRole = User::find($userId)->role_id;
				if($userRole == 1){
					$usersIdToUpdate[] = $userId;
				}
				else {
					App::abort(500, 'Error');
				}   
			}
			if(preg_match("#^delete-(.*)$#i", $key)) {
			    
			    if (($pos = strpos($key, "-")) !== FALSE) { 
				    $userId = substr($key, $pos+1); 
				}
				else {
					$userId = NULL;
				}
			    
			    $userRole = User::find($userId)->role_id;
				if($userRole == 1 || $userRole == 2){
					$usersIdToDelete[] = $userId;
				}
				else {
					App::abort(500, 'Error');
				}
					
			}		
		}
		
		User::whereIn('id',$usersIdToUpdate)->update(['role_id' => 2]);
		User::whereIn('id',$usersIdToDelete)->delete();
		
		return redirect()->route('admin');
        
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Role extends Model
{
	public function users()
	{
	    return $this->hasMany('App\User');
	}
	
    public function getUserRole() {
    	
		$userRole = $this->select('name')->where('roles.id', '=', Auth::user()->role_id)->first();
		return $userRole['name'];
	
	}
}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'surname'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
     
    public function roles()
	{
	    return $this->belongsTo('App\Role', 'role_id');
	}
	
	public function userCourse()
	{
	    return $this->hasMany('App\UserCourse');
	}
    
    public function hasRole($roleName)
    {
    	
        if ($this->roles->name == $roleName)
        {
            return true;
        }

        return false;
    }
    
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	protected $fillable = ['name'];
	
    public static function getGroups() {
		return self::all()->where('name', '!=', 'Преподаватели')->where('name', '!=', 'Администраторы'		);
	
	}
}

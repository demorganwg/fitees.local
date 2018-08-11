<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function getGroups() {

		return $this->all('id', 'name')->where('name', '!=', 'Преподаватели');
	
	}
}

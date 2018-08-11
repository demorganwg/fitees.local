<?php

namespace App\Repositories;

use App\Role;

abstract class RolesRepository {
	
	public function __construct(Role $role) {
		
		$this->model = $role;
		
	}
	
}

?>
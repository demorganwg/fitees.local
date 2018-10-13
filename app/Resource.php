<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
	protected $fillable = ['name', 'description', 'file', 'number', 'alias', 'resource_type_id', 'course_id'];
	
    public function type()
	{
	    return $this->belongsTo('App\ResourceType', 'resource_type_id');
	}
	
	public static function getResourceByAlias($resourceAlias) {
		
		return self::where('alias', $resourceAlias)->firstOrFail();
		
	}
}

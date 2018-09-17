<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;


use Validator;
use App\Group;

class GroupController extends SiteController
{

	public function __construct()
    {

		parent::__construct();
		
    }
    
     public function store(Request $request) {
		
		$input = $request->except(['_token']);

		$validator = Validator::make($input, [
			'name' => 'required|max:255|unique:groups',
		]);
		
		if($validator->fails()) {
			return redirect()
			->route('admin')
			->withErrors($validator);
		}
		
		$group = new Group;
		$group->fill($input);
		
		if($group->save()){
		    return redirect()->route('admin');
		}
		else {
			App::abort(500, 'Error');
		}
		
	}
    
    public function edit($groupId) {
    	
		$group = Group::find($groupId);	
		$old = $group->toArray();
		
		if(view()->exists(env('THEME').'.admin.group-edit')) {
			
			$title = 'Редактировать группу '.$old['name'];
	    	$this->vars = array_add($this->vars, 'title', $title);
	    	$this->vars = array_add($this->vars, 'groupId', $groupId);
	    	$this->vars = array_add($this->vars, 'data', $old);
	    	
	    	$this->template = env('THEME').'.admin.group-edit';
	    	return $this->renderOutput();
			
		}
		
		$this->vars = array_add($this->vars, 'group', $group);
		$this->template = env('THEME').'.admin.group-edit';
        return $this->renderOutput();
		
	}
	
	public function update(Request $request, $groupId) {
    	
		$group = Group::find($groupId);
		$input = $request->except(['_token']);
		
		$validator = Validator::make($input, [
			'name' => 'required|max:255|unique:groups,name,'.$group->id,
		]);
		
		if($validator->fails()) {
			return redirect()
			->route('admin.groups.edit', ['id' => $group->id])
			->withErrors($validator);
		}
		
		$group->fill($input);
		
		if($group->update()) {
			return redirect()->route('admin');
		}
		else {
			App::abort(500, 'Error');
		}
		
	}
	
	public function destroy(Request $request, $groupId) {
    	
		$group = Group::find($groupId);
        $group->delete();
       	return redirect()->route('admin');   
		
	}
    
}

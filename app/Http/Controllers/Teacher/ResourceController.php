<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;

use App\Course;
use App\Resource;
use App\ResourceType;
use Validator;

class ResourceController extends SiteController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($courseAlias)
    {
        
        $course = Course::getCourseByAlias($courseAlias);
        $courseResources = $course->resources()->orderBy('number')->get();
        
        foreach($courseResources as $resource){
			$resource['type'] = $resource->type->name;
		}
        
        $title = 'Материалы курса курса '.$course['name'];
    	$this->vars = array_add($this->vars, 'title', $title);
    					
		$this->vars = array_add($this->vars, 'course', $course);
		$this->vars = array_add($this->vars, 'courseResources', $courseResources);
		
		$this->template = env('THEME').'.teacher.resources-index';	
        return $this->renderOutput();
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($courseAlias)
    {
        
        $title = 'Добавить материал';
    	$this->vars = array_add($this->vars, 'title', $title);
    	
    	$this->vars = array_add($this->vars, 'courseAlias', $courseAlias);
    	$this->vars = array_add($this->vars, 'types', ResourceType::all());
    	
    	$this->template = env('THEME').'.teacher.resources-create';
    	return $this->renderOutput();
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $courseAlias)
    {
        $course = Course::getCourseByAlias($courseAlias);
        $input = $request->except(['_token']);
		$input['course_id'] = $course->id;
		$input['number'] = $course->resources()->count()+1;

		$validator = Validator::make($input, [
			'name' => 'required|max:255',
			'alias' => 'required|max:150|unique:resources',
			'file' => 'file',
			'course_id' => 'exists:courses,id',
		]);
		
		if($validator->fails()) {
			return redirect()
			->route('teacher.resources.create',['course_alias' => $courseAlias])
			->withErrors($validator);
		}
		
		$resource = new Resource;
		$resource->fill($input);
		
		if($resource->save()){
		    return redirect()->route('teacher.resources.index', ['course_alias' => $courseAlias]);
		}
		else {
			App::abort(500, 'Error');
		}
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($courseAlias, $resourceAlias)
    {
        $course = Course::getCourseByAlias($courseAlias);
		$resource = Resource::getResourceByAlias($resourceAlias);
        $resource['type'] = $resource->type->name;
		
		$title = $resource->name;
    	$this->vars = array_add($this->vars, 'title', $title);
    	
    	$this->vars = array_add($this->vars, 'courseAlias', $courseAlias);
    	$this->vars = array_add($this->vars, 'resource', $resource);
    	
    	$this->template = env('THEME').'.teacher.resources-show';
    	return $this->renderOutput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($courseAlias, $resourceAlias)
    {
        
        $course = Course::getCourseByAlias($courseAlias);
		$resource = Resource::getResourceByAlias($resourceAlias);
		
		$old = $resource->toArray();
		
		if(view()->exists(env('THEME').'.teacher.resources-edit')) {
			
			$title = 'Редактировать материал: '.$old['name'];
	    	$this->vars = array_add($this->vars, 'title', $title);
	    	$this->vars = array_add($this->vars, 'courseAlias', $courseAlias);
	    	$this->vars = array_add($this->vars, 'resourceAlias', $resourceAlias);
	    	$this->vars = array_add($this->vars, 'data', $old);
	    	$this->vars = array_add($this->vars, 'types', ResourceType::all());
	    	
	    	$this->template = env('THEME').'.teacher.resources-edit';
	    	return $this->renderOutput();
			
		}
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $courseAlias, $resourceAlias)
    {
        
        $course = Course::getCourseByAlias($courseAlias);
        $resource = Resource::getResourceByAlias($resourceAlias);
    	$input = $request->except(['_token']);
			
		$validator = Validator::make($input, [
			'name' => 'required|max:255',
			'alias' => 'required|max:150|unique:resources,alias,'.$resource->id,
			'resource_type_id' => 'exists:resources,resource_type_id'
		]);

		if($validator->fails()) {
			dd($validator);
			return redirect()
			->route('teacher.resources.edit', ['course_alias' => $courseAlias, 'resource' => $resourceAlias])
			->withErrors($validator);
		}
		
		$resource->fill($input);
		
		if($resource->update()){
		    return redirect()->route('teacher.resources.show', 
		    	[
				    'course_alias' => $courseAlias, 
				    'resource' => $resourceAlias
			    ]);
		}
		else {
			App::abort(500, 'Error');
		}
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($courseAlias, $resourceAlias)
    {
        $resource = Resource::getResourceByAlias($resourceAlias);
        $resource->delete();
       	return redirect()->route('teacher.resources.index', ['course_alias' => $courseAlias]);   
    }
    
    public function changeResourcePosition(Request $request, $courseAlias) {
		
    	$input = $request->except(['_token']);
		
		$rules = array();
		foreach($input as $n => $id) {
			$rules[$n] = 'numeric|exists:resources,id';
		}
		
		$validator = Validator::make($input, $rules);

		if($validator->fails()) {
			return redirect()
			->route('teacher.resources.index', ['course_alias' => $courseAlias])
			->withErrors($validator);
		}
		
		$resources = array();
		$resourceNumber = 0;
		
		foreach($input as $resource){
			$resources[++$resourceNumber] = Resource::find($resource);	
			$resources[$resourceNumber]['number'] = $resourceNumber ;	
			$resources[$resourceNumber]->update();
		}

		return redirect()->route('teacher.resources.index', 
    	[
		    'course_alias' => $courseAlias
	    ]);

		
	}
}

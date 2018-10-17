<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;

use Auth;
use Validator;
use App\Course;

class CourseController extends SiteController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $title = 'FITees Teacher Home';
    	$this->vars = array_add($this->vars, 'title', $title);
    	
    	$author_id = Auth::user()->id;
    	$teacherCourses = Course::getAuthorCourses($author_id);
							
		$this->vars = array_add($this->vars, 'teacherCourses', $teacherCourses);
		$this->template = env('THEME').'.teacher.courses-index';	
        return $this->renderOutput();
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $title = 'Добавить курс';
    	$this->vars = array_add($this->vars, 'title', $title);
    	
    	$this->template = env('THEME').'.teacher.courses-create';
    	return $this->renderOutput();
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $input = $request->except(['_token']);
			
		$validator = Validator::make($input, [
			'name' => 'required|max:255|unique:courses',
			'alias' => 'required|max:150|unique:courses'
		]);
		
		if($validator->fails()) {
			return redirect()
			->route('teacher.courses.create')
			->withErrors($validator);
		}
		
		if($request->hasFile('image')) {
			
			$file = $request->file('image');
			$input['image'] = $file->GetClientOriginalName();
			$file->move(public_path().'/assets/img/courses', $input['image']);
			
		}
		else {
			$input['image'] = NULL;
		}
		
		$input['author_id'] = Auth::user()->id;
		
		$course = new Course;
		$course->fill($input);
		
		if($course->save()){
		    return redirect()->route('teacher.courses.index')
//					->with('status', 'Курс добавлен')
			;
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
    public function show($courseAlias)
    {
        $course = Course::getCourseByAlias($courseAlias);
    	$course['author'] = Auth::user()->name .' '.Auth::user()->surname;
		$course['topics'] = $course->topics()->orderBy('number')->get();
		$course['assignments'] = $course->assignments()->orderBy('number')->get();
		$course['resources'] = $course->resources()->orderBy('number')->get();
		
		$title = $course->name;
    	$this->vars = array_add($this->vars, 'title', $title);
    	
    	$this->vars = array_add($this->vars, 'course', $course);
    	
    	$this->template = env('THEME').'.teacher.courses-show';
    	return $this->renderOutput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($courseAlias)
    {
        
        $course = Course::getCourseByAlias($courseAlias);
		
		$old = $course->toArray();
		
		if(view()->exists(env('THEME').'.teacher.courses-edit')) {
			
			$title = 'Редактировать курс '.$old['name'];
	    	$this->vars = array_add($this->vars, 'title', $title);
	    	$this->vars = array_add($this->vars, 'courseAlias', $courseAlias);
	    	$this->vars = array_add($this->vars, 'data', $old);
	    	
	    	$this->template = env('THEME').'.teacher.courses-edit';
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
    public function update(Request $request, $courseAlias)
    {
    	$course = Course::getCourseByAlias($courseAlias);
    	$input = $request->except(['_token']);
			
		$validator = Validator::make($input, [
			'name' => 'required|max:255|unique:courses,name,'.$course->id,
			'alias' => 'required|max:150|unique:courses,alias,'.$course->id,
		]);
		
		if($validator->fails()) {
			return redirect()
			->route('teacher.courses.edit', ['course' => $courseAlias])
			->withErrors($validator);
		}
		
		if($request->hasFile('image')) {
			$file = $request->file('image');
			$input['image'] = $file->GetClientOriginalName();
			$file->move(public_path().'/assets/img/course_img', $input['image']);
		}
		else {
			$input['image'] = $input['old_image'];
		}
		
		unset( $input['old_image']);
		
		$course->fill($input);
		
		if($course->update()) {
			return redirect()->route('teacher.courses.show', ['course' => $input['alias'] ]);
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
    public function destroy($courseAlias)
    {
        $course = Course::getCourseByAlias($courseAlias);
        $course->delete();
       	return redirect()->route('teacher.courses.index');    
    }
}

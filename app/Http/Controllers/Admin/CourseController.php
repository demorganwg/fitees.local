<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;

use Auth;
use Validator;
use App\Course;
use App\User;

class CourseController extends SiteController
{

    public function show($courseAlias)
    {
        $course = Course::getCourseByAlias($courseAlias);
        $author = User::find($course->author_id);
    	$course['author'] = $author->name.' '.$author->surname;
		$course['topics'] = $course->topics()->orderBy('number')->get();
		$course['assignments'] = $course->assignments()->orderBy('number')->get();
		$course['resources'] = $course->resources()->orderBy('number')->get();
		
		$title = $course->name;
    	$this->vars = array_add($this->vars, 'title', $title);
    	
    	$this->vars = array_add($this->vars, 'course', $course);
    	
    	$this->template = env('THEME').'.admin.courses-show';
    	return $this->renderOutput();
    }

    public function edit($courseAlias)
    {
        
        $course = Course::getCourseByAlias($courseAlias);
		
		$old = $course->toArray();
		
		if(view()->exists(env('THEME').'.admin.courses-edit')) {
			
			$title = 'Редактировать курс '.$old['name'];
	    	$this->vars = array_add($this->vars, 'title', $title);
	    	$this->vars = array_add($this->vars, 'courseAlias', $courseAlias);
	    	$this->vars = array_add($this->vars, 'data', $old);
	    	
	    	$this->template = env('THEME').'.admin.courses-edit';
	    	return $this->renderOutput();
			
		}
		 
    }

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
			->route('admin.courses.edit', ['course' => $courseAlias])
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
			return redirect()->route('admin.courses.show', ['course' => $input['alias'] ]);
		}
		else {
			App::abort(500, 'Error');
		}
    	
    }

    public function destroy($courseAlias)
    {
        $course = Course::getCourseByAlias($courseAlias);
        $course->delete();
       	return redirect()->route('admin');    
    }
    
    public function publishCourse($courseAlias)
    {
    	
        $course = Course::getCourseByAlias($courseAlias);
        if($course->status == 0){
			$course->status = 1;
		}
		elseif($course->status == 1) {
			$course->status = 0;
		}
		else {
			App::abort(500, 'Error');
		}
		
		if($course->update()) {
			return redirect()->route('admin.courses.show', ['course' => $courseAlias]);
		}
        
    }
}

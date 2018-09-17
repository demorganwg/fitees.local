<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;

use App\Course;
use App\Assignment;
use App\Question;
use Validator;

class AssignmentController extends SiteController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($courseAlias)
    {
        
        $course = Course::getCourseByAlias($courseAlias);
        $courseAssignments = $course->assignments()->orderBy('number')->get();
        
        $title = 'Материалы курса: '.$course['name'];
    	$this->vars = array_add($this->vars, 'title', $title);
    					
		$this->vars = array_add($this->vars, 'course', $course);
		$this->vars = array_add($this->vars, 'courseAssignments', $courseAssignments);
		
		$this->template = env('THEME').'.teacher.assignments-index';	
        return $this->renderOutput();
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($courseAlias)
    {
        
        $title = 'Добавить задание';
    	$this->vars = array_add($this->vars, 'title', $title);
    	
    	$this->vars = array_add($this->vars, 'courseAlias', $courseAlias);
    	
    	$this->template = env('THEME').'.teacher.assignments-create';
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
		$input['number'] = $course->assignments()->count()+1;

		$validator = Validator::make($input, [
			'name' => 'required|max:255',
			'alias' => 'required|max:150|unique:assignments',
			'course_id' => 'exists:courses,id',
		]);
		
		if($validator->fails()) {
			return redirect()
			->route('teacher.assignments.create', ['course_alias' => $courseAlias])
			->withErrors($validator);
		}
		
		$assignment = new Assignment;
		$assignment->fill($input);
		
		if($assignment->save()){
		    return redirect()->route('teacher.assignments.index', ['course_alias' => $courseAlias]);
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
    public function show($courseAlias, $assignmentAlias)
    {
        $course = Course::getCourseByAlias($courseAlias);
		$assignment = Assignment::getAssignmentByAlias($assignmentAlias);
		
		$assignment['questions'] = $assignment->questions()->orderBy('number')->get();
		
		foreach ($assignment['questions'] as $question) {
			$question['shortname'] = strip_tags(mb_substr($question['content'], 0, 50));
		}
		
		$title = $assignment->name;
    	$this->vars = array_add($this->vars, 'title', $title);
    	
    	$this->vars = array_add($this->vars, 'courseAlias', $courseAlias);
    	$this->vars = array_add($this->vars, 'assignment', $assignment);
    	
    	$this->template = env('THEME').'.teacher.assignments-show';
    	return $this->renderOutput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($courseAlias, $assignmentAlias)
    {
        
        $course = Course::getCourseByAlias($courseAlias);
		$assignment = Assignment::getAssignmentByAlias($assignmentAlias);
		
		$old = $assignment->toArray();
		
		if(view()->exists(env('THEME').'.teacher.assignments-edit')) {
			
			$title = 'Редактировать материал: '.$old['name'];
	    	$this->vars = array_add($this->vars, 'title', $title);
	    	$this->vars = array_add($this->vars, 'courseAlias', $courseAlias);
	    	$this->vars = array_add($this->vars, 'assignmentAlias', $assignmentAlias);
	    	$this->vars = array_add($this->vars, 'data', $old);
	    	
	    	$this->template = env('THEME').'.teacher.assignments-edit';
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
    public function update(Request $request, $courseAlias, $assignmentAlias)
    {
        
        $course = Course::getCourseByAlias($courseAlias);
        $assignment = Assignment::getAssignmentByAlias($assignmentAlias);
    	$input = $request->except(['_token']);
			
		$validator = Validator::make($input, [
			'name' => 'required|max:255',
			'alias' => 'required|max:150|unique:assignments,alias,'.$assignment->id,
		]);

		if($validator->fails()) {
			dd($validator);
			return redirect()
			->route('teacher.assignments.edit', ['course_alias' => $courseAlias, 'assignment' => $assignmentAlias])
			->withErrors($validator);
		}
		
		$assignment->fill($input);
		
		if($assignment->update()){
		    return redirect()->route('teacher.assignments.show', 
		    	[
				    'course_alias' => $courseAlias, 
				    'assignment' => $assignmentAlias
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
    public function destroy($courseAlias, $assignmentAlias)
    {
        $assignment = Assignment::getAssignmentByAlias($assignmentAlias);
        $assignment->delete();
       	return redirect()->route('teacher.assignments.index', ['course_alias' => $courseAlias]);  
    }
    
    public function changeAssignmentPosition(Request $request, $courseAlias) {
		
    	$input = $request->except(['_token']);
		
		$rules = array();
		foreach($input as $n => $id) {
			$rules[$n] = 'numeric|exists:assignments,id';
		}
		
		$validator = Validator::make($input, $rules);

		if($validator->fails()) {
			return redirect()
			->route('teacher.assignments.index', ['course_alias' => $courseAlias])
			->withErrors($validator);
		}
		
		$assignments = array();
		$assignmentNumber = 0;
		
		foreach($input as $assignment){
			$assignments[++$assignmentNumber] = Assignment::find($assignment);	
			$assignments[$assignmentNumber]['number'] = $assignmentNumber ;	
			$assignments[$assignmentNumber]->update();
		}

		return redirect()->route('teacher.assignments.index', 
    	[
		    'course_alias' => $courseAlias
	    ]);

	}
	
	public function changeQuestionPosition(Request $request, $courseAlias, $assignmentAlias) {
		
		$course = Course::getCourseByAlias($courseAlias);
        $assignment = Assignment::getAssignmentByAlias($assignmentAlias);
    	$input = $request->except(['_token']);
		
		$rules = array();
		
		foreach($input as $n => $id) {
			$rules[$n] = 'numeric|exists:questions,id';
		}
		
		$validator = Validator::make($input, $rules);

		if($validator->fails()) {
			return redirect()
			->route('teacher.assignments.show', ['course_alias' => $course['alias'], 'assignment' => $assignment['alias']])
			->withErrors($validator);
		}
		
		$questions = array();
		$questionNumber = 0;
		
		foreach($input as $question){
			$questions[++$questionNumber] = Question::find($question);	
			$questions[$questionNumber]['number'] = $questionNumber ;	
			$questions[$questionNumber]->update();
		}
		
		return redirect()->route('teacher.assignments.show', 
    	[
		    'course_alias' => $course['alias'], 
		    'assignment' => $assignment['alias']
	    ]);

		
	}
}

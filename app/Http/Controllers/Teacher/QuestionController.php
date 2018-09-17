<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;

use App\Course;
use App\Assignment;
use App\Question;
use App\Answer;
use Validator;

class QuestionController extends SiteController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($courseAlias, $assignmentAlias)
    {
        $title = 'Добавить вопрос';
    	$this->vars = array_add($this->vars, 'title', $title);
    	
    	$this->vars = array_add($this->vars, 'courseAlias', $courseAlias);
    	$this->vars = array_add($this->vars, 'assignmentAlias', $assignmentAlias);
    	
    	$this->template = env('THEME').'.teacher.questions-create';
    	return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $courseAlias, $assignmentAlias)
    {
        $assignment = Assignment::getAssignmentByAlias($assignmentAlias);
        $input = $request->except(['_token']);
		$input['assignment_id'] = $assignment->id;
		$input['number'] = $assignment->questions()->count()+1;
		
		$validator = Validator::make($input, [
			'content' => 'required',
		]);
		
		if($validator->fails()) {
			return redirect()
			->route('teacher.questions.create',['course_alias' => $courseAlias, 'assignment' => $assignmentAlias])
			->withErrors($validator);
		}
		
		$question = new Question;
		$question->fill($input);
		
		
		if($question->save()){
		    return redirect()->route('teacher.assignments.show', ['course_alias' => $courseAlias, 'assignment' => $assignmentAlias]);
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($courseAlias, $assignmentAlias, $questionNumber)
    {
        
        $assignment = Assignment::getAssignmentByAlias($assignmentAlias);
		$question = Question::getQuestionByNumber($assignment->id, $questionNumber);
		$question['answers'] = $question->answers;

		$old = $question->toArray();

		if(view()->exists(env('THEME').'.teacher.questions-edit')) {
			
			$title = 'Редактировать вопрос '.$old['number'];
	    	$this->vars = array_add($this->vars, 'title', $title);
	    	$this->vars = array_add($this->vars, 'courseAlias', $courseAlias);
	    	$this->vars = array_add($this->vars, 'assignmentAlias', $assignmentAlias);
	    	$this->vars = array_add($this->vars, 'question', $question);
	    	$this->vars = array_add($this->vars, 'data', $old);
	    	
	    	$this->template = env('THEME').'.teacher.questions-edit';
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
    public function update(Request $request, $courseAlias, $assignmentAlias, $questionNumber)
    {
        $assignment = Assignment::getAssignmentByAlias($assignmentAlias);
		$question = Question::getQuestionByNumber($assignment->id, $questionNumber);
        $input = $request->except(['_token', '_method']);
        $records = $request->except(['_method', '_token', 'content']);
        
        $rules = array();
		$rules = array_add($rules, 'content', 'required');
		
		foreach($records as $n => $record) {
			$rules[$n] = 'required|max:255';
		}
		
		$validator = Validator::make($input, $rules);
		
		if($validator->fails()) {
			return redirect()
			->route('teacher.questions.edit', ['course_alias' => $course['alias'], 'assignment' => $assignmentAlias, 'question' => $questionNumber])
			->withErrors($validator);
		}
		
		$question->fill($input);

		if($question->update()){
			$answers = Answer::getQuestionAnswers($question->id);
			foreach($answers as $answer) {
				$answer->delete();
			}
			foreach($records as $key => $record) {
				if(preg_match("#^answer-(.*)$#i", $key)) {
					
				    if (($pos = strpos($key, "-")) !== FALSE) { 
					    $answerNumber = substr($key, $pos+1); 
					}
					else {
						$userId = NULL;
					}
				    
				    if( array_key_exists( 'is_correct-'.$answerNumber , $records )) {
						$answerToSave = new Answer;
					    $answerToSave->content = $record;
					    $answerToSave->is_correct = 1;
					    $answerToSave->question_id = $question->id;
					    $answerToSave->save();
					}
					else {
						$answerToSave = new Answer;
					    $answerToSave->content = $record;
					    $answerToSave->is_correct = 0;
					    $answerToSave->question_id = $question->id;
					    $answerToSave->save();
					}
				}	
			}
			
		    return redirect()->route('teacher.assignments.show', 
		    	[
				    'course_alias' => $courseAlias, 
				    'assignment' => $assignmentAlias, 
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
    public function destroy($courseAlias, $assignmentAlias, $questionNumber)
    {
        $assignment = Assignment::getAssignmentByAlias($assignmentAlias);
        $question = Question::getQuestionByNumber($assignment->id, $questionNumber);
        $question->delete();
       	return redirect()->route('teacher.assignments.show', [
       		'course_alias' => $courseAlias, 'assignment' => $assignmentAlias,
       	]);
    }
}

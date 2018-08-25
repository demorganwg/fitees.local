<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;

/*use App\Question;
use App\Answer;*/
use Auth;
use App\Assignment;
use App\AssignmentResult;
use App\Course;
use App\UserCourse;



class AssignmentController extends SiteController
{
    
    public function __construct()
    {
		parent::__construct();		
    }
    
    public function run($courseAlias, $assignmentAlias) {
		
		$assignment = Assignment::getAssignmentByAlias($assignmentAlias);
		$assignmentQuestions = $assignment->questions()->orderBy('number')->get();
		
		$assignmentNavigation = view(env('THEME').'.user.assignments-navigation', 
							['assignmentQuestions' => $assignmentQuestions, 
							'courseAlias' => $courseAlias,
							'assignmentAlias' => $assignmentAlias])
							->render();
				
		foreach($assignmentQuestions as $question) {
			$question['answers'] = $question->answers;
		}
					
		$title = Assignment::getAssignmentByAlias($assignmentAlias)->name;;
		$this->vars = array_add($this->vars, 'title', $title);
		
		$this->vars = array_add($this->vars, 'assignmentNavigation', $assignmentNavigation);
		$this->vars = array_add($this->vars, 'courseAlias', $courseAlias);
		$this->vars = array_add($this->vars, 'assignmentAlias', $assignmentAlias);
		$this->vars = array_add($this->vars, 'assignmentQuestions', $assignmentQuestions);
		
		$this->template = env('THEME').'.user.assignment';
        return $this->renderOutput();
		
	}
	
	public function submit(Request $request, $courseAlias, $assignmentAlias) {
		
		if($request->isMethod('post')){
			
			$result = $request->except(['_token'])['question'];
			
			$user = Auth::user();
			$course = Course::getCourseByAlias($courseAlias);
			$assignment = Assignment::getAssignmentByAlias($assignmentAlias);
			
			$userResults = self::calculateResults($assignment, $result);
			self::insertAssignmentsResult($user->id, $course->id, $assignment->id, $result, $userResults['userScore']);
			
		}
		else {
			App::abort(400, 'Error');
		}
			
		session(['userResults' => $userResults]);									
											
		return redirect()->route('assignment.show.result', [
												'alias' => $courseAlias,
												'assignment_alias' => $assignmentAlias,
												]);
		
	}
	
	private function calculateResults($assignment, array $userAnswers) {
		
		$assignmentQuestions = $assignment->questions()->orderBy('number')->get();
		$rightAnswers = array();
		
		$userResults['maxScore'] = env('ASSIGNMENT_SCALE');
		$userResults['userScore'] = 0;
		$userResults['userRightAnswers'] = 0;
		$userResults['rightAnswerMax'] = 0;
		$userResults['rightAnswerValue'] = 0;
		
		foreach($assignmentQuestions as $q => $question) {
			
			$question['answers'] = $question->answers;
			
			foreach($question['answers'] as $a => $answer) {
				$rightAnswers['q'.($q+1)]['a'.($a+1)] = $answer['is_correct'];
				if($answer['is_correct'] == 1)	{
					$userResults['rightAnswerMax']++;
				}	
			}
			
		}
		
		$userResults['rightAnswerValue'] = $userResults['maxScore']/$userResults['rightAnswerMax'];
		
		foreach($userAnswers as $q => $questionAnswers) {
			
//			dump('user '.$q.':');
//			dump($userAnswers[$q]);
//			dump('right '.$q.':');
//			dump($rightAnswers[$q]);
			
			foreach($questionAnswers as $a => $answer) {
				
				if($userAnswers[$q][$a] && $rightAnswers[$q][$a] == 1){
					$userResults['userRightAnswers']++;
				}
				
				/*dump('user '.$a.':');
				dump($userAnswers[$q][$a]);
				dump('right '.$a.':');
				dump($rightAnswers[$q][$a]);*/
				
			}
		}
		
		$userResults['userScore'] = $userResults['userRightAnswers']*$userResults['rightAnswerValue'];
		
		return $userResults;
		
	}
	
	private function insertAssignmentsResult($userId, $courseId, $assignmentId, $answers, $userScore) {
		
		$user_course = UserCourse::getCourseResults($userId, $courseId);
		
		$assignment_result = new AssignmentResult;
		$assignment_result->score = $userScore;
		$assignment_result->answers = json_encode($answers);
		$assignment_result->user_course_id = $user_course->id;
		$assignment_result->assignment_id = $assignmentId;
		
		
		if(!$assignment_result->save()){
		    App::abort(500, 'Error');
		}
		
	}
	
	public function showResult($courseAlias, $assignmentAlias) {
		
		$title = Assignment::getAssignmentByAlias($assignmentAlias)->name;;
		$this->vars = array_add($this->vars, 'title', $title);
		
		$userResults = session('userResults', NULL);
		
		$this->vars = array_add($this->vars, 'userResults', $userResults);
		$this->template = env('THEME').'.user.assignment-result';
        return $this->renderOutput();
		
	}
	
	
	
	
    
}

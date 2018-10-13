<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;

use App\Course;
use App\Group;
use App\User;
use App\UserCourse;
use App\Assignment;
use App\AssignmentResult;

class StudentsController extends SiteController
{
   
   public function index($courseAlias)
   {
   	
   		$title = 'Студенты, участвующие в курсе';
    	$this->vars = array_add($this->vars, 'title', $title);
    	
    	$course = Course::getCourseByAlias($courseAlias);
    	
    	$groups = Group::getGroups();
    	
    	foreach ($groups as $group) {
    		
    		$group['active'] = 0;
			
			$group['students'] = User::getAllUsersInGroup($group['id'])->values();
			
			foreach ($group['students'] as $student) {
				
				$record = UserCourse::getCourseResults($student->id, $course->id);
				
				if($record) {
					
					$group['active'] = 1;
					
					switch ($record['status']) {
					    case 0:
					    	$student['status'] = 'Ожидает';
					        break;
					    case 1:
					        $student['status'] = 'Активен';
					        break;
					    case 2:
					        $student['status'] = 'Завершил';
					        break;
					    default:
					       
					}
					
					$student['score'] = $record['score'];
					
				} else {
					$student['status'] = 'Не участвует';
				}
				
			}
			
		}
    	
    	$this->vars = array_add($this->vars, 'groups', $groups);
    	$this->vars = array_add($this->vars, 'course', $course);
    	
		$this->template = env('THEME').'.teacher.student-index';	
        return $this->renderOutput();
   	
   }
   
   public function showStudentStats($courseAlias, $studentId) {
   	
   		$course = Course::getCourseByAlias($courseAlias);
   		$student = User::find($studentId);
   		$courseAssignments = Assignment::getCourseAssignments($course->id)->values();
   		$userCourse = UserCourse::where('course_id', $course->id)->where('user_id', $studentId)->first();
   		$title = 'Статистика '.$student->name.' '.$student->surname;
    	
    	foreach ($courseAssignments as $assignment) {
			
			if($assignmentResult = AssignmentResult::where('assignment_id', $assignment->id)
													->where('user_course_id', $userCourse->id)->first()) 
			{
				$assignment['date'] = date('d-m-Y',strtotime($assignmentResult['completion_date']));
				$assignment['time'] = date('H:i:s',strtotime($assignmentResult['completion_date']));
				$assignment['score'] = $assignmentResult['score'];
			} else {
				$assignment['date'] = '---';
				$assignment['time'] = '---';
				$assignment['score'] = '---';
			}
			
		}
    	
    	$this->vars = array_add($this->vars, 'title', $title);
    	$this->vars = array_add($this->vars, 'course', $course);
    	$this->vars = array_add($this->vars, 'student', $student);
    	$this->vars = array_add($this->vars, 'courseAssignments', $courseAssignments);
    	
		$this->template = env('THEME').'.teacher.show-student-stats';	
        return $this->renderOutput();
   	
   }
   
   public function inviteStudent(Request $request, $courseAlias) {
   	
   		$course = Course::getCourseByAlias($courseAlias);
		
    	$input = $request->except(['_token']);
    	
    	$record = new UserCourse;
    	$record['status'] = 1;
    	$record['score'] = 0;
    	$record['user_id'] = $input['student_id'];
    	$record['course_id'] = $course->id;
		
		if($record->save()){
		    return redirect()->route('course.show.students', ['course_alias' => $courseAlias]);
		}
		else {
			App::abort(500, 'Error');
		}

	}
	
	public function graduateStudent(Request $request, $courseAlias) {
   	
   		$course = Course::getCourseByAlias($courseAlias);
		
    	$input = $request->except(['_token']);
    	
    	$record = UserCourse::where('user_id', '=', $input['student_id'])->where('course_id', '=', $course->id)->first();
    	
    	$record['status'] = 2;
		
		if($record->update()){
		    return redirect()->route('course.show.students', ['course_alias' => $courseAlias]);
		}
		else {
			App::abort(500, 'Error');
		}

	}
	
	public function submitStudent(Request $request, $courseAlias) {
   	
   		$course = Course::getCourseByAlias($courseAlias);
		
    	$input = $request->except(['_token']);
    	
    	$record = UserCourse::where('user_id', '=', $input['student_id'])->where('course_id', '=', $course->id)->first();
    	
    	$record['status'] = 1;
		
		if($record->update()){
		    return redirect()->route('course.show.students', ['course_alias' => $courseAlias]);
		}
		else {
			App::abort(500, 'Error');
		}

	}
	
	public function declineStudent(Request $request, $courseAlias) {
   	
   		$course = Course::getCourseByAlias($courseAlias);
		
    	$input = $request->except(['_token']);
    	
    	$record = UserCourse::where('user_id', '=', $input['student_id'])->where('course_id', '=', $course->id)->first();
    	
		if($record->delete()){
		    return redirect()->route('course.show.students', ['course_alias' => $courseAlias]);
		}
		else {
			App::abort(500, 'Error');
		}

	}
	
	 public function inviteGroup(Request $request, $courseAlias) {
   	
   		$course = Course::getCourseByAlias($courseAlias);
		
    	$input = $request->except(['_token']);
    	
    	$students = User::all()->where('group_id', '=', $input['group_id'])->values();
    	
    	foreach ($students as $key => $student) {
			
			if(UserCourse::userActiveInCourse($student['id'], $course->id)) {
				$students->forget($key);
			} 
			else {
				
				$record = new UserCourse;
		    	$record['status'] = 1;
		    	$record['score'] = 0;
		    	$record['user_id'] = $student['id'];
		    	$record['course_id'] = $course->id;
		    	
		    	if($record->save()){
				    return redirect()->route('course.show.students', ['course_alias' => $courseAlias]);
				}
				else {
					App::abort(500, 'Error');
				}
			}
		}
		
		return redirect()->route('course.show.students', ['course_alias' => $courseAlias]);

	}
   
}

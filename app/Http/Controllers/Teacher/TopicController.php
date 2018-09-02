<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;

use App\Course;
use App\Topic;
use App\Page;
use Validator;


class TopicController extends SiteController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($courseAlias)
    {
        $course = Course::getCourseByAlias($courseAlias);
        $courseTopics = $course->topics()->orderBy('number')->get();
        
        foreach($courseTopics as $topic){
			$topic['pages'] = $topic->pages;
		}
        
        $title = 'Темы курса '.$course['name'];
    	$this->vars = array_add($this->vars, 'title', $title);
    					
		$this->vars = array_add($this->vars, 'course', $course);
		$this->vars = array_add($this->vars, 'courseTopics', $courseTopics);
		
		$this->template = env('THEME').'.teacher.topics-index';	
        return $this->renderOutput();
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($courseAlias)
    {
        $course = Course::getCourseByAlias($courseAlias);
        
        $title = 'Добавить тему';
    	$this->vars = array_add($this->vars, 'title', $title);
    	
    	$this->vars = array_add($this->vars, 'course', $course);
    	
    	$this->template = env('THEME').'.teacher.topics-create';
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
		$input['number'] = $course->topics()->count()+1;
		
		$validator = Validator::make($input, [
			'name' => 'required|max:255',
			'alias' => 'required|max:150|unique:topics',
			'number' => 'numeric|min:0'
		]);
		
		if($validator->fails()) {
			return redirect()
			->route('teacher.topics.create',['course_alias' => $courseAlias])
			->withErrors($validator);
		}
		
		$topic = new Topic;
		$topic->fill($input);
		
		if($topic->save()){
		    return redirect()->route('teacher.topics.index', ['course_alias' => $courseAlias]);
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
    public function show($courseAlias, $topicAlias)
    {
        
        $course = Course::getCourseByAlias($courseAlias);
        $topic = Topic::getTopicByAlias($topicAlias);
        $topic['pages'] = $topic->pages()->orderBy('number')->get();
		
		$title = 'Редактировать тему: '.$topic->name;
    	$this->vars = array_add($this->vars, 'title', $title);
    	
    	$this->vars = array_add($this->vars, 'course', $course);
    	$this->vars = array_add($this->vars, 'topic', $topic);
    	
    	$this->template = env('THEME').'.teacher.topics-show';
    	return $this->renderOutput();
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($courseAlias, $topicAlias)
    {
    	
    	$course = Course::getCourseByAlias($courseAlias);
		$topic = Topic::getTopicByAlias($topicAlias);
		
		$old = $topic->toArray();
		
		if(view()->exists(env('THEME').'.teacher.topics-edit')) {
			
			$title = 'Редактировать тему '.$old['name'];
	    	$this->vars = array_add($this->vars, 'title', $title);
	    	$this->vars = array_add($this->vars, 'course', $course);
	    	$this->vars = array_add($this->vars, 'topic', $topic);
	    	$this->vars = array_add($this->vars, 'data', $old);
	    	
	    	$this->template = env('THEME').'.teacher.topics-edit';
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
    public function update(Request $request, $courseAlias, $topicAlias)
    {
        
        $course = Course::getCourseByAlias($courseAlias);
        $topic = Topic::getTopicByAlias($topicAlias);
    	$input = $request->except(['_token']);
			
		$validator = Validator::make($input, [
			'name' => 'required|max:255',
			'alias' => 'required|max:150|unique:topics,alias,'.$topic->id,
			'number' => 'numeric|min:0'
		]);
		
		if($validator->fails()) {
			return redirect()
			->route('teacher.topics.edit', ['course_alias' => $course['alias'], 'topic' => $topic['alias']])
			->withErrors($validator);
		}
		
		$topic->fill($input);
		
		if($topic->update()){
		    return redirect()->route('teacher.topics.show', 
		    	[
				    'course_alias' => $course['alias'], 
				    'topic' => $topic['alias']
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
    public function destroy($courseAlias, $topicAlias)
    {
        $course = Course::getCourseByAlias($courseAlias);
        $topic = Topic::getTopicByAlias($topicAlias);
        $topic->delete();
       	return redirect()->route('teacher.topics.index', ['course_alias' => $course['alias']]);   
    }
    
    public function changePagePosition(Request $request, $courseAlias, $topicAlias) {
		
		$course = Course::getCourseByAlias($courseAlias);
        $topic = Topic::getTopicByAlias($topicAlias);
    	$input = $request->except(['_token']);
		
		$rules = array();
		
		foreach($input as $n => $id) {
			$rules[$n] = 'numeric|exists:pages,id';
		}
		
		$validator = Validator::make($input, $rules);

		if($validator->fails()) {
			return redirect()
			->route('teacher.topics.show', ['course_alias' => $course['alias'], 'topic' => $topic['alias']])
			->withErrors($validator);
		}
		
		$pages = array();
		$pageNumber = 0;
		
		foreach($input as $page){
			$pages[++$pageNumber] = Page::find($page);	
			$pages[$pageNumber]['number'] = $pageNumber ;	
			$pages[$pageNumber]->update();
		}
		
		return redirect()->route('teacher.topics.show', 
    	[
		    'course_alias' => $course['alias'], 
		    'topic' => $topic['alias']
	    ]);

		
	}
	
	public function changeTopicPosition(Request $request, $courseAlias) {
		
		$course = Course::getCourseByAlias($courseAlias);
    	$input = $request->except(['_token']);
		
		$rules = array();
		foreach($input as $n => $id) {
			$rules[$n] = 'numeric|exists:topics,id';
		}
		
		$validator = Validator::make($input, $rules);

		if($validator->fails()) {
			return redirect()
			->route('teacher.topics.index', ['course_alias' => $course['alias']])
			->withErrors($validator);
		}
		
		$topics = array();
		$topicsNumber = 0;
		
		foreach($input as $topic){
			$topics[++$topicsNumber] = Topic::find($topic);	
			$topics[$topicsNumber]['number'] = $topicsNumber ;	
			$topics[$topicsNumber]->update();
		}

		return redirect()->route('teacher.topics.index', 
    	[
		    'course_alias' => $course['alias']
	    ]);

		
	}
}

<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;

use App\Course;
use App\Topic;
use App\Page;
use Validator;

class PageController extends SiteController
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
    public function create($courseAlias, $topicAlias)
    {
        
        $title = 'Добавить страницу';
    	$this->vars = array_add($this->vars, 'title', $title);
    	
    	$this->vars = array_add($this->vars, 'courseAlias', $courseAlias);
    	$this->vars = array_add($this->vars, 'topicAlias', $topicAlias);
    	
    	$this->template = env('THEME').'.teacher.pages-create';
    	return $this->renderOutput();
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $courseAlias, $topicAlias)
    {
    	
        $topic = Topic::getTopicByAlias($topicAlias);
        $input = $request->except(['_token']);
		$input['topic_id'] = $topic->id;
		$input['number'] = $topic->pages()->count()+1;

		$validator = Validator::make($input, [
			'name' => 'required|max:255',
		]);
		
		if($validator->fails()) {
			return redirect()
			->route('teacher.pages.create',['course_alias' => $courseAlias, 'topic' => $topicAlias])
			->withErrors($validator);
		}
		
		$page = new Page;
		$page->fill($input);
		
		
		if($page->save()){
		    return redirect()->route('teacher.topics.show', ['course_alias' => $courseAlias, 'topic' => $topicAlias]);
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
    public function show($courseAlias, $topicAlias, $pageNumber)
    {
        
        $topic = Topic::getTopicByAlias($topicAlias);
        $page = Page::getPageByNumber($topic->id, $pageNumber);
		
		$title = 'Страница: '.$page->name;
    	$this->vars = array_add($this->vars, 'title', $title);
    	
    	$this->vars = array_add($this->vars, 'courseAlias', $courseAlias);
    	$this->vars = array_add($this->vars, 'topicAlias', $topicAlias);
    	$this->vars = array_add($this->vars, 'page', $page);
    	
    	$this->template = env('THEME').'.teacher.pages-show';
    	return $this->renderOutput();
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($courseAlias, $topicAlias, $pageNumber)
    {
        
		$topic = Topic::getTopicByAlias($topicAlias);
		$page = Page::getPageByNumber($topic->id, $pageNumber);
		
		$old = $page->toArray();
		
		if(view()->exists(env('THEME').'.teacher.pages-edit')) {
			
			$title = 'Редактировать страницу '.$old['name'];
	    	$this->vars = array_add($this->vars, 'title', $title);
	    	$this->vars = array_add($this->vars, 'courseAlias', $courseAlias);
	    	$this->vars = array_add($this->vars, 'topicAlias', $topicAlias);
	    	$this->vars = array_add($this->vars, 'page', $page);
	    	$this->vars = array_add($this->vars, 'data', $old);
	    	
	    	$this->template = env('THEME').'.teacher.pages-edit';
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
    public function update(Request $request, $courseAlias, $topicAlias, $pageNumber)
    {
        $topic = Topic::getTopicByAlias($topicAlias);
        $page = Page::getPageByNumber($topic->id, $pageNumber);
        
    	$input = $request->except(['_token']);
			
		$validator = Validator::make($input, [
			'name' => 'required|max:255',
			'number' => 'numeric|min:0'
		]);
		
		if($validator->fails()) {
			return redirect()
			->route('teacher.pages.edit', ['course_alias' => $course['alias'], 'topic' => $topic['alias'], 'page' => $pageNumber])
			->withErrors($validator);
		}
		
		$page->fill($input);
		
		if($page->update()){
		    return redirect()->route('teacher.pages.show', 
		    	[
				    'course_alias' => $courseAlias, 
				    'topic' => $topicAlias, 
				    'page' => $pageNumber
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
    public function destroy($courseAlias, $topicAlias, $pageNumber)
    {
        $topic = Topic::getTopicByAlias($topicAlias);
        $page = Page::getPageByNumber($topic->id, $pageNumber);
        $page->delete();
       	return redirect()->route('teacher.topics.show', ['course_alias' => $courseAlias, 'topic' => $topicAlias]);   
    }
}

@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="col-2">
	{!! $topicNavigation !!}
</div>
<div class="content col-10">
	<div class="container">
		<h2>{{ $page['name'] }}</h2>
		{!! $page['content'] !!}
		<ul class="page_navigation">
			@if($pagination['showPrev'])
				<li><a href="{!! url('/courses/'.$courseAlias.'/topics/'.$page->topic->alias.'/'.$pagination['PrevPage']); !!}">Prev</a></li>
			@endif
			
			@foreach($topicPageList as $topicPage)
				<li><a href="{!! url('/courses/'.$courseAlias.'/topics/'.$topicPage->topic->alias.'/'.$topicPage['number']); !!}">{{ $topicPage['number'] }}</a></li>
			@endforeach
			@if($pagination['showNext'])
				<li><a href="{!! url('/courses/'.$courseAlias.'/topics/'.$page->topic->alias.'/'.$pagination['NextPage']); !!}">Next</a></li>
			@endif
		</ul>
	</div>	
</div>
<style>
	h2 {
		font-size: 20px;
		margin: 2rem 0;
	}
	p {
		margin: 1rem 0;
	}
	.page_navigation {
		list-style-type: none;
		padding: 0;
		margin: 50px auto;
		text-align: center;
	}
	.page_navigation li {
		display: inline-block;
		margin-right: 5px;
	}
	.page_navigation li a {
		padding: 5px 10px;
		border: 1px solid #b3e5fc;
		text-decoration: none;
		color: #b3e5fc;
		transition: .2s all ease;
	}
	.page_navigation li a:hover {
		border: 1px solid blue;
		color: blue;
	}
	
</style>
@endsection

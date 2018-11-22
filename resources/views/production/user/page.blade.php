@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section nav-sidebar">
	<nav class="sidebar_left">
		{!! $topicNavigation !!}
	</nav>
	<div class="content_container">
		<h2>{{ $page['name'] }}</h2>
		<div class="page_text">
			{!! $page['content'] !!}
		</div>
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
</section>
@endsection

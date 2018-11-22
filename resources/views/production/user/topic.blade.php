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
		<h3>{{ $currentTopic['name'] }}</h3>
		<p>{{ $currentTopic['description'] }}</p>
		<ol class="topic">
			@foreach ($currentTopic['pages'] as $page)
				<li><a href="{!! url('/courses/'.$courseAlias.'/topics/'.$currentTopic['alias'].'/'.$page['number']); !!}">{{ $page['name'] }}</a></li>
			@endforeach
		</ol>
	</div>	
</section>
@endsection

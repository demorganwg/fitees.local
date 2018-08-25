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
		<div class="course_page">
			<h3>{{ $currentTopic['name'] }}</h3>
			<p>{{ $currentTopic['description'] }}</p>
			<ol>
				@foreach ($currentTopic['pages'] as $page)
					<li><a href="{!! url('/courses/'.$courseAlias.'/topics/'.$currentTopic['alias'].'/'.$page['number']); !!}">{{ $page['name'] }}</a></li>
				@endforeach
			</ol>
		</div>
	</div>	
</div>
@endsection

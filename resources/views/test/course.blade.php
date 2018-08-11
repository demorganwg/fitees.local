@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<div class="container">
		<div class="course_page">
			<h2>{{ $course['name'] }}</h2>
			<img src="{{ asset(env('THEME')) }}/{{ $course['image'] }}" alt="{{ $course['name'] }}">
			<h3>Автор курса: {{ $course['author'] }}</h3>
			@if($course['showApllyForm'])
				<form method="POST" action="{!! url('/course/'.$course['alias']); !!}">
					@csrf
					<input id="courseId" name="courseId" type="hidden" value="{{ $course['id'] }}" />
					<button type="submit" class="btn-apply">Подать заявку на участие</button>
				</form>
			@elseif($course['showCourseStatus'])
				<p class="btn-apply">{{ $course['status'] }}</p>
			@endif
			{!! $course['description'] !!}
			<h3>Темы курса</h3>
			<ul>
				@foreach ($course['topics'] as $topic)
					<li>{{ $topic['name'] }}</li>
				@endforeach
			</ul>
			<h3>Задания курса</h3>
			<ul>
				@foreach ($course['assignments'] as $assignment)
					<li>{{ $assignment['name'] }}</li>
				@endforeach
			</ul>
			<h3>Материалы</h3>
			<ul>
				@foreach ($course['resources'] as $resource)
					<li>{{ $resource['name'] }}</li>
				@endforeach
			</ul>
			{!! $course['info'] !!}
			<!--<a href="{!! url('/course/'.$course['alias']); !!}"></a>-->
		</div>
	</div>	
</div>
<style>
	.course_page img {
		margin-bottom: 30px;
	}
</style>
@endsection

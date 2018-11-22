@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section course_page">
	<h2>{{ $course['name'] }}</h2>
	<img src="{{ asset('assets') }}/img/course_img/{{ $course['image'] }}" alt="{{ $course['name'] }}">
	<h3>Автор курса: {{ $course['author'] }}</h3>
	@if($course['showApllyForm'])
		<form class="form-apply" method="POST" action="{!! url('/courses/'.$course['alias']); !!}">
			@csrf
			<input id="courseId" name="courseId" type="hidden" value="{{ $course['id'] }}" />
			<button type="submit" class="btn btn-lg btn-primary">Подать заявку на участие</button>
		</form>
	@elseif($course['showCourseStatus'])
		<p class="btn-apply">{{ $course['status'] }}</p>
	@endif
	{!! $course['description'] !!}
	<h3>Темы курса</h3>
	<ol>
		@foreach ($course['topics'] as $topic)
			<li>{{ $topic['name'] }}</li>
		@endforeach
	</ol>
	<h3>Задания курса</h3>
	<ol>
		@foreach ($course['assignments'] as $assignment)
			<li>{{ $assignment['name'] }}</li>
		@endforeach
	</ol>
	<h3>Материалы</h3>
	<ol>
		@foreach ($course['resources'] as $resource)
			<li>{{ $resource['name'] }}</li>
		@endforeach
	</ol>
	{!! $course['info'] !!}
</section>
@endsection

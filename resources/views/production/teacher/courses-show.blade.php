@extends (env('THEME').'.layouts.teacher')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section course_page">
	<h2>{{ $course['name'] }}</h2>
	<img src="{{ asset('assets') }}/img/course_img/{{ $course['image'] }}" alt="{{ $course['name'] }}">
	<a class="btn btn-lg btn-primary" href="{{ route('teacher.courses.edit', ['course_alias' => $course['alias']]) }}">Редактировать</a>
	<a class="btn btn-lg" href="{{ route('course.show.students', ['course_alias' => $course['alias']]) }}">Учащиеся</a>
	<h3>Автор курса: {{ $course['author'] }}</h3>
	{!! $course['description'] !!}
	<h3>Темы курса</h3>
	<a class="btn btn-lg" href="{{ route('teacher.topics.index', ['course_alias' => $course['alias']])}}">Редактировать</a>
	<a class="btn btn-lg btn-primary" href="{{ route('teacher.topics.create', ['course_alias' => $course['alias']])}}">Создать</a>
	<ol>
		@foreach ($course['topics'] as $topic)
			<li><a href="{{ route('teacher.topics.show', ['course_alias' => $course['alias'], 'topic' => $topic['alias']])}}">{{ $topic['name'] }}</a></li>
		@endforeach
	</ol>
	<h3>Задания курса</h3>
	<a class="btn btn-lg" href="{{ route('teacher.assignments.index', ['course_alias' => $course['alias']])}}">Редактировать</a>
	<a class="btn btn-lg btn-primary" href="{{ route('teacher.assignments.create', ['course_alias' => $course['alias']])}}">Создать</a>
	<ol>
		@foreach ($course['assignments'] as $assignment)
			<li><a href="{{ route('teacher.assignments.show', ['course_alias' => $course['alias'], 'assignment' => $assignment['alias']])}}">{{ $assignment['name'] }}</a></li>
		@endforeach
	</ol>
	<h3>Материалы</h3>
	<a class="btn btn-lg" href="{{ route('teacher.resources.index', ['course_alias' => $course['alias']])}}">Редактировать</a>
	<a class="btn btn-lg btn-primary" href="{{ route('teacher.resources.create', ['course_alias' => $course['alias']])}}">Создать</a>
	<ol>
		@foreach ($course['resources'] as $resource)
			<li><a href="{{ route('teacher.resources.show', ['course_alias' => $course['alias'], 'resource' => $resource['alias']])}}">{{ $resource['name'] }}</a></li>
		@endforeach
	</ol>
	<h3>Информация о курсе</h3>
	{!! $course['info'] !!}
</section>
@endsection

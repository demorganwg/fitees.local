@extends (env('THEME').'.layouts.teacher')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section course_page">
	<h2>{{ $course['name'] }}</h2>
	<img src="{{ asset('assets') }}/img/course_img/{{ $course['image'] }}" alt="{{ $course['name'] }}">
	<form method="POST" action="{{ action('Admin\CourseController@publishCourse', ['courseAlias' => $course['alias']]) }}"  enctype="multipart/form-data">
		@csrf
		<a class="btn btn-primary btn-lg" href="{{ route('admin.courses.edit', ['course_alias' => $course['alias']]) }}">Редактировать</a>
		@if ($course['status'] == 0)
			<button type="submit" class="btn btn-lg">Активировать</button>
		@elseif ($course['status'] == 1)
			<button type="submit" class="btn btn-lg">Деактивировать</button>
		@endif
	</form>
	<form method="POST" action="{{ route('admin.courses.destroy', ['course' => $course['alias']]) }}"  enctype="multipart/form-data">
		@method('DELETE')
		@csrf
		<button type="submit" class="btn btn-lg">Удалить</button>
	</form>
	<h3>Автор курса: {{ $course['author'] }}</h3>
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
	<h3>Информация о курсе</h3>
	{!! $course['info'] !!}
</section>
@endsection

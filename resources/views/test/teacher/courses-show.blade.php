@extends (env('THEME').'.layouts.teacher')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<div class="container">
		<div class="course_page">
			<h2>{{ $course['name'] }}</h2>
			<img src="{{ asset('assets') }}/img/course_img/{{ $course['image'] }}" alt="{{ $course['name'] }}">
			<a class="btn btn-icon" href="{{ route('teacher.courses.edit', ['course_alias' => $course['alias']]) }}">Редактировать</a>
			<a class="btn btn-icon" href="#">Статистика</a>
			<a class="btn btn-icon" href="#">Пригласить</a>
			<h3>Автор курса: {{ $course['author'] }}</h3>
			@if($course['showApllyForm'])
				<form method="POST" action="{!! url('/courses/'.$course['alias']); !!}">
					@csrf
					<input id="courseId" name="courseId" type="hidden" value="{{ $course['id'] }}" />
					<button type="submit" class="btn-apply">Подать заявку на участие</button>
				</form>
			@elseif($course['showCourseStatus'])
				<p class="btn-apply">{{ $course['status'] }}</p>
			@endif
			{!! $course['description'] !!}
			<h3>Темы курса</h3>
			<a class="btn btn-icon" href="{{ route('teacher.topics.index', ['course_alias' => $course['alias']])}}">Редактировать</a>
			<a class="btn btn-icon" href="{{ route('teacher.topics.create', ['course_alias' => $course['alias']])}}">Создать</a>
			<ol>
				@foreach ($course['topics'] as $topic)
					<li><a href="{{ route('teacher.topics.show', ['course_alias' => $course['alias'], 'topic' => $topic['alias']])}}">{{ $topic['name'] }}</a></li>
				@endforeach
			</ol>
			<h3>Задания курса</h3>
			<a class="btn btn-icon" href="#">Редактировать</a>
			<a class="btn btn-icon" href="#">Создать</a>
			<ol>
				@foreach ($course['assignments'] as $assignment)
					<li>{{ $assignment['name'] }}</li>
				@endforeach
			</ol>
			<h3>Материалы</h3>
			<a class="btn btn-icon" href="#">Редактировать</a>
			<a class="btn btn-icon" href="#">Создать</a>
			<ol>
				@foreach ($course['resources'] as $resource)
					<li>{{ $resource['name'] }}</li>
				@endforeach
			</ol>
			<h3>Информация о курсе</h3>
			{!! $course['info'] !!}
		</div>
	</div>	
</div>
<style>
	h3 {
		margin-top: 40px;
	}
	.btn.btn-icon {
		display: inline-block;
		text-decoration: none;
		margin: 0 auto 10px;
		padding: 5px 10px;
		border: 1px solid #b3e5fc;
		transition: .2s all ease;
	}
	.btn.btn-icon:hover {
		background-color: #b3e5fc;
		color: #fff;
	}
	.course_page img {
		margin-bottom: 30px;
	}
</style>
@endsection

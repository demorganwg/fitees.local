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
			<a class="btn btn-icon" href="{{ route('admin.courses.edit', ['course_alias' => $course['alias']]) }}">Редактировать</a>
			<form method="POST" action="{{ action('Admin\CourseController@publishCourse', ['courseAlias' => $course['alias']]) }}"  enctype="multipart/form-data">
				@csrf
				@if ($course['status'] == 0)
					<button type="submit" class="btn btn-send">Активировать</button>
				@elseif ($course['status'] == 1)
					<button type="submit" class="btn btn-send">Деактивировать</button>
				@endif
			</form>
			<form method="POST" action="{{ route('admin.courses.destroy', ['course' => $course['alias']]) }}"  enctype="multipart/form-data">
				@method('DELETE')
				@csrf
				<button type="submit" class="btn btn-send">Удалить</button>
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
	form {
		display: inline-block;
	}
</style>
@endsection

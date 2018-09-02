@extends (env('THEME').'.layouts.teacher')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<h2>Страница TEACH Учителя</h2>
	<h2>Мои курсы</h2>
		<div class="courses_wrap row">
			@if(!$teacherCourses->isEmpty())
				@foreach ($teacherCourses as $teacherCourse)
					<div class="course_item col-3">
						<img src="{{ asset('assets') }}/img/course_img/{{ $teacherCourse['image'] }}" alt="{{ $teacherCourse['name'] }}">
		<!--				<a href="{{ url('/teacher/'.$teacherCourse['alias']) }}"><h3>{{ $teacherCourse['name'] }}</h3></a>-->
						<a href="{{ route('teacher.courses.show', ['course_alias' => $teacherCourse['alias']]) }}"><h3>{{ $teacherCourse['name'] }}</h3></a>
						<ul class="course-menu">
							<li><a href="{{ route('teacher.courses.edit', ['course_alias' => $teacherCourse['alias']]) }}">Редактировать</a></li>
							<li><a href="#">Статистика</a></li>
							<li><a href="#">Пригласить</a></li>
						</ul>
					</div>
				@endforeach
			@else
				<p>Вы еще не создали ни одного курса</p>
			@endif
			<div class="col-3 button-container">
				<a href="{{ route('teacher.courses.create') }}" class="btn btn-create">Создать<br> курс</a>
			</div>
		</div>
</div>
<style>
	.course-menu {
		list-style-type: none;
		margin: 0;
		padding: 0;
		text-align: left;
	}
	.button-container {
		padding-left: 40px;
		padding-top: 40px;	
	}
	.btn-create {
		width: 100px;
		height: 100px;
		
		text-decoration: none;
		text-align: center;
		margin: 0;
		display: flex;
		align-items: center;
	}
	.btn-create:hover {
		text-decoration: none;
	}
</style>
@endsection

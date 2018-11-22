@extends (env('THEME').'.layouts.teacher')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section">
	<h2>Мои курсы</h2>
		<div class="courses_wrap">
			@if(!$teacherCourses->isEmpty())
				@foreach ($teacherCourses as $teacherCourse)
					<div class="course">
						<img src="{{ asset('assets') }}/img/course_img/{{ $teacherCourse['image'] }}" alt="{{ $teacherCourse['name'] }}">
						<a href="{{ route('teacher.courses.show', ['course_alias' => $teacherCourse['alias']]) }}">{{ $teacherCourse['name'] }}</a>
						<ul class="course-menu">
							<li class="btn btn-lg btn-block"><a href="{{ route('teacher.courses.edit', ['course_alias' => $teacherCourse['alias']]) }}">Редактировать</a></li>
							<li class="btn btn-lg btn-block"><a href="{{ route('course.show.students', ['course_alias' => $teacherCourse['alias']]) }}">Статистика</a></li>
						</ul>
					</div>
				@endforeach
			@else
				<p>Вы еще не создали ни одного курса</p>
			@endif
			<div class="button-container">
				<a href="{{ route('teacher.courses.create') }}" class="btn btn-primary btn-lg">Создать<br> курс</a>
			</div>
		</div>
</section>
@endsection

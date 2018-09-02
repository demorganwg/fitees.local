@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
	<div class="content col-12">
		@if (Auth::user()->hasRole('Unknown'))
			<h2>Страница LEARN неподтвержденного пользователя</h2>
			<p>Ожидайте подтверждения от администратора</p>
		@endif
		@if (Auth::user()->hasRole('Student'))
			<h2>Страница LEARN Студента</h2>
			<h2>Мои курсы</h2>
			<div class="courses_wrap row">
				@if(!$userCourses->isEmpty())
					@foreach ($userCourses as $userCourse)
						<div class="course_item col-3">
							<img src="{{ asset('assets') }}/img/course_img/{{ $userCourse['image'] }}" alt="{{ $userCourse['name'] }}">
							@if ($userCourse['showCourseLink'])
								<a href="{!! url('/courses/'.$userCourse['alias'].'/menu'); !!}"><h3>{{ $userCourse['name'] }}</h3></a>
							@else
								<a href="{!! url('/courses/'.$userCourse['alias']); !!}"><h3>{{ $userCourse['name'] }}</h3></a>
							@endif
							
							<p>{{ $userCourse['statusMessage'] }}</p>
						</div>
					@endforeach
				@else
					<p>Вы еще не принимали участия ни в одном курсе</p>
				@endif
				
			</div>
		@endif
	</div>
@endsection

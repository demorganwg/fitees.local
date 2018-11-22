@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section">
	@if (Auth::user()->hasRole('Unknown'))
		<h2>Ожидайте подтверждения от администратора</h2>
	@endif
	@if (Auth::user()->hasRole('Student'))
		<h2>Мои курсы</h2>
		<div class="courses_wrap">
			@if(!$userCourses->isEmpty())
				@foreach ($userCourses as $userCourse)
					<div class="course">
						<img src="{{ asset('assets') }}/img/course_img/{{ $userCourse['image'] }}" alt="{{ $userCourse['name'] }}">
						@if ($userCourse['showCourseLink'])
							<a href="{!! url('/courses/'.$userCourse['alias'].'/menu'); !!}">{{ $userCourse['name'] }}</a>
						@else
							<a href="{!! url('/courses/'.$userCourse['alias']); !!}">{{ $userCourse['name'] }}</a>
						@endif
						<p>{{ $userCourse['statusMessage'] }}</p>
					</div>
				@endforeach
			@else
				<p>Вы еще не принимали участия ни в одном курсе</p>
			@endif
			
		</div>
	@endif
</section>
@endsection

@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section">
	<div class="courses_wrap">
		@foreach ($course_list as $course)
			<div class="course">
				<img src="{{ asset('assets') }}/img/course_img/{{ $course['image'] }}" alt="{{ $course['name'] }}">
				<a href="{!! url('/courses/'.$course['alias']); !!}">{{ $course['name'] }}</a>
				<p>{!! $course['description'] !!}</p>
			</div>
		@endforeach
	</div>
</section>
@endsection

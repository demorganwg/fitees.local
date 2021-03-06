@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<div class="courses_wrap row">
		@foreach ($course_list as $course)
			<div class="course_item col-3">
				<img src="{{ asset('assets') }}/img/course_img/{{ $course['image'] }}" alt="{{ $course['name'] }}">
				<a href="{!! url('/courses/'.$course['alias']); !!}"><h3>{{ $course['name'] }}</h3></a>
				{!! $course['description'] !!}
			</div>
		@endforeach
	</div>
</div>
@endsection

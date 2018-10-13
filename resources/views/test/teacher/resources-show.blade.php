@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/jquery-dragarrange/drag-arrange.min.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<div class="container">
		<div class="course_page">
			<h3>{{ $resource['name'] }}</h3>
			<a class="btn btn-icon" href="{{ route('teacher.resources.edit', ['course_alias' => $courseAlias, 'resource' => $resource['alias']]) }}">Редактировать</a>
			
			@if ($resource['resource_type_id'] == 2)
			<a class="download-link" href="{{ asset('assets') }}/courses/{{ $courseAlias }}/{{ $resource['file'] }}">{{ $resource['file'] }}</a>
			@endif
			
			@if ($resource['resource_type_id'] == 3)
			<video controls>
			  <source src="{{ asset('assets') }}/courses/{{ $courseAlias }}/{{ $resource['file'] }}">
			</video>
			<a class="download-link" href="{{ asset('assets') }}/courses/{{ $courseAlias }}/{{ $resource['file'] }}">Скачать</a>
			@endif
			
			@if ($resource['resource_type_id'] == 4)
			<img src="{{ asset('assets') }}/courses/{{ $courseAlias }}/{{ $resource['file'] }}" alt="Image">
			<a class="download-link" href="{{ asset('assets') }}/courses/{{ $courseAlias }}/{{ $resource['file'] }}">Скачать</a>
			@endif
			
			@if ($resource['resource_type_id'] == 5)
			<a class="download-link" href="{{ asset('assets') }}/courses/{{ $courseAlias }}/{{ $resource['file'] }}">{{ $resource['file'] }}</a>
			@endif
			
			{!! $resource['description'] !!}

		</div>
	</div>	
</div>

<style>
	video {
		display: block;
		margin: 20px 0;
		width: 640px;
		height: auto;
	}
	.download-link {
		display: block;
		margin: 20px 0;
	}
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

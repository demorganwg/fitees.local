@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/jquery-dragarrange/drag-arrange.min.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section show_resource">
	<h3>{{ $resource['name'] }}</h3>
	<a class="btn btn-lg btn-primary" href="{{ route('teacher.resources.edit', ['course_alias' => $courseAlias, 'resource' => $resource['alias']]) }}">Редактировать</a>
	@if ($resource['resource_type_id'] == 2)
	<div class="media_container">
		<a class="download-link" href="{{ asset('assets') }}/courses/{{ $courseAlias }}/{{ $resource['file'] }}">{{ $resource['file'] }}</a>
	</div>
	@endif
	@if ($resource['resource_type_id'] == 3)
	<div class="media_container">
		<video controls>
			<source src="{{ asset('assets') }}/courses/{{ $courseAlias }}/{{ $resource['file'] }}">
		</video>
		<a class="btn btn-lg download-link" href="{{ asset('assets') }}/courses/{{ $courseAlias }}/{{ $resource['file'] }}">Скачать</a>
	</div>
	@endif
	@if ($resource['resource_type_id'] == 4)
	<div class="media_container">
		<img src="{{ asset('assets') }}/courses/{{ $courseAlias }}/{{ $resource['file'] }}" alt="Image">
		<a class="btn btn-lg download-link" href="{{ asset('assets') }}/courses/{{ $courseAlias }}/{{ $resource['file'] }}">Скачать</a>
	</div>
	@endif
	@if ($resource['resource_type_id'] == 5)
	<div class="media_container">
		<a class="btn btn-lg" href="{{ asset('assets') }}/courses/{{ $courseAlias }}/{{ $resource['file'] }}">{{ $resource['file'] }}</a>
	</div>
	@endif
	{!! $resource['description'] !!}
</section>

@endsection

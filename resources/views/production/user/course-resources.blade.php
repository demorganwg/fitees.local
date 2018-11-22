@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section show_resource">
	<h3>Материалы курса</h3>
	<ul>
	@foreach ($resources as $resource)
		<li>
			@if ($resource['resource_type_id'] == 2)
			<h3>{{ $resource['name'] }}</h3>
			<div class="media_container">
				<a class="download-link" href="{{ asset('assets') }}/courses/{{ $courseAlias }}/{{ $resource['file'] }}">{{ $resource['file'] }}</a>
			</div>
			@endif
			
			@if ($resource['resource_type_id'] == 3)
			<div class="media_container">
				<video controls>
					<source src="{{ asset('assets') }}/courses/{{ $courseAlias }}/{{ $resource['file'] }}">
				</video>
				<a class="download-link btn btn-lg" href="{{ asset('assets') }}/courses/{{ $courseAlias }}/{{ $resource['file'] }}">Скачать</a>
			</div>
			@endif
			
			@if ($resource['resource_type_id'] == 4)
			<div class="media_container">
				<img src="{{ asset('assets') }}/courses/{{ $courseAlias }}/{{ $resource['file'] }}" alt="Image">
				<a class="download-link" href="{{ asset('assets') }}/courses/{{ $courseAlias }}/{{ $resource['file'] }}">Скачать</a>
			</div>
			@endif
			
			@if ($resource['resource_type_id'] == 5)
			<div class="media_container">
				<a class="download-link" href="{{ asset('assets') }}/courses/{{ $courseAlias }}/{{ $resource['file'] }}">{{ $resource['file'] }}</a>
			</div>
			@endif
			
			{!! $resource['description'] !!}
		</li>
	@endforeach
	</ul>
</section>
@endsection

@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<div class="container">
		<div class="course_page">
			<h3>Материалы курса</h3>
			<ul>
			@foreach ($resources as $resource)
				<li>
					@if ($resource['resource_type_id'] == 2)
					<h3>{{ $resource['name'] }}</h3>
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
				</li>
			@endforeach
			</ul>
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
	.course_page .btn {
		width: 320px;
	}
</style>
@endsection

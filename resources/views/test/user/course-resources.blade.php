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
					<a href="{!! url('/courses/'.$courseAlias.'/resources/'.$resource['alias']); !!}">{{ $resource['name'] }}</a>
					<p>{{ $resource['description'] }}</p>
				</li>
			@endforeach
			</ul>
		</div>
	</div>	
</div>
<style>
	.course_page .btn {
		width: 320px;
	}
</style>
@endsection

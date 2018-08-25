@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<div class="container">
		<div class="course_page">
			<h3>Задания</h3>
			<ul>
				@foreach ($assignments as $assignment)
					<li>
						<a href="{!! url('/courses/'.$courseAlias.'/assignments/'.$assignment['alias']); !!}">{{ $assignment['name'] }}</a>
						<p>{{ $assignment['description'] }}</p>
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

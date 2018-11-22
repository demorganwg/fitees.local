@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section">
	<h3>Задания</h3>
	<ul>
		@foreach ($assignments as $assignment)
			<li>
				<a href="{!! url('/courses/'.$courseAlias.'/assignments/'.$assignment['alias']); !!}">{{ $assignment['name'] }}</a>
				<p>{{ $assignment['description'] }}</p>
				</li>
		@endforeach
	</ul>
</section>
@endsection

@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section">
	<h3>Темы курса</h3>
	<ul>
		@foreach ($topics as $topic)
		<li>
			<a href="{!! url('/courses/'.$courseAlias.'/topics/'.$topic['alias']); !!}">{{ $topic['name'] }}</a>
			<p>{{ $topic['description'] }}</p>
		</li>
		@endforeach
	</ul>
</section>
@endsection

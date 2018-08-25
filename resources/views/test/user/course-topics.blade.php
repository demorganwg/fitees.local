@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<div class="container">
		<div class="course_page">
			<h3>Темы курса</h3>
			<ul>
				@foreach ($topics as $topic)
				<li>
					<a href="{!! url('/courses/'.$courseAlias.'/topics/'.$topic['alias']); !!}">{{ $topic['name'] }}</a>
					<p>{{ $topic['description'] }}</p>
				</li>
				@endforeach
			</ul>
		</div>
	</div>	
</div>
@endsection

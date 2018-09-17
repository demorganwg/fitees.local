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
			<p>{{ $resource['type'] }}</p>
			<a class="btn btn-icon" href="{{ route('teacher.resources.edit', ['course_alias' => $courseAlias, 'resource' => $resource['alias']]) }}">Редактировать</a>
			<p>{{ $resource['description'] }}</p>
			
			
		</div>
	</div>	
</div>

<style>
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

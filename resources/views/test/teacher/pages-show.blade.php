@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<div class="container">
		<div class="course_page">
			<h3>{{ $page['name'] }}</h3>
			<a class="btn btn-icon" href="{{ route('teacher.pages.edit', ['course_alias' => $courseAlias, 'topic' => $topicAlias, 'page' => $page['number']]) }}">Редактировать</a>
			<div class="page_content">{!! $page['content'] !!}</div>
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

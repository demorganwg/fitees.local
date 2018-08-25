@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<div class="container">
		<div class="course_page">
			<a href="{!! url('/courses/'.$courseAlias.'/run'); !!}" class="btn">Запуск курса</a>
			<a href="{!! url('/courses/'.$courseAlias.'/topics'); !!}" class="btn">Темы</a>
			<a href="{!! url('/courses/'.$courseAlias.'/assignments'); !!}" class="btn">Задания</a>
			<a href="{!! url('/courses/'.$courseAlias.'/resources'); !!}" class="btn">Материалы</a>
			<a href="{!! url('/courses/'.$courseAlias.'/results'); !!}" class="btn">Результаты</a>
		</div>
	</div>	
</div>
<style>
	.course_page img {
		margin-bottom: 30px;
	}
	.course_page .btn {
		width: 320px;
	}
</style>
@endsection

@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section">
	<div class="course_menu">
		<a href="{!! url('/courses/'.$courseAlias.'/run'); !!}" class="btn btn-lg btn-block">Запуск курса</a>
		<a href="{!! url('/courses/'.$courseAlias.'/topics'); !!}" class="btn btn-lg btn-block">Темы</a>
		<a href="{!! url('/courses/'.$courseAlias.'/assignments'); !!}" class="btn btn-lg btn-block">Задания</a>
		<a href="{!! url('/courses/'.$courseAlias.'/resources'); !!}" class="btn btn-lg btn-block">Материалы</a>
		<a href="{!! url('/courses/'.$courseAlias.'/results'); !!}" class="btn btn-lg btn-block">Результаты</a>
	</div>
</section>
@endsection

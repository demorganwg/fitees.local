@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section">
	<h3>{{ $page['name'] }}</h3>
	<a class="btn btn-lg btn-primary" href="{{ route('teacher.pages.edit', ['course_alias' => $courseAlias, 'topic' => $topicAlias, 'page' => $page['number']]) }}" style="margin-bottom: 20px">Редактировать</a>
	<div class="page_content">{!! $page['content'] !!}</div>	
</section>
@endsection

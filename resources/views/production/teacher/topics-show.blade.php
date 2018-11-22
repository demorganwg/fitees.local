@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/jquery-dragarrange/drag-arrange.min.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section">
	<h3>{{ $topic['name'] }}</h3>
	<a class="btn btn-lg btn-primary" href="{{ route('teacher.topics.edit', ['course_alias' => $course['alias'], 'topic' => $topic['alias']]) }}" style="margin-bottom: 20px">Редактировать</a>
	<p>{{ $topic['description'] }}</p>
	<h3>Список страниц</h3>
	<a class="btn btn-lg btn-primary" href="{{ route('teacher.pages.create', ['course_alias' => $course['alias'], 'topic' => $topic['alias']]) }}">Создать страницу</a>
	<button id="btn-order" class="btn btn-lg">Изменить порядок</button>
	<form class="list_wrap" method="POST" action="{{ action('Teacher\TopicController@changePagePosition', ['course_alias' => $course['alias'], 'topic' => $topic['alias']]) }}">
		@csrf	
		<div class="drag-wrap" style="margin: 20px 0">
			<ul class="drag-numbers">
				@foreach ($topic['pages'] as $n => $page)
					<li>{{ $n+1 }}</li>
				@endforeach
				</ul>
			<ul class="drag-list">
				@foreach ($topic['pages'] as $n => $page)
					<li>
						<a href="{{ route('teacher.pages.show', ['course_alias' => $course['alias'], 'topic' => $topic['alias'], 'page' => $page['number']])}}">{{ $page['name'] }}</a>
						<span class="drag-area"></span>
						<input type="hidden" name="old-number-{{ $page['number'] }}" value="{{ $page['id'] }}">
					</li>
				@endforeach
			</ul>
		</div>
		<button type="submit" id="btn-save" class="btn btn-lg btn-primary">Сохранить изменения</button>
	</form>	
</section>
<script>
	$('.drag-list li').arrangeable({dragSelector: '.drag-area'});
	
	$('#btn-order').on("click", function() {
		$(this).toggleClass("active");
		$('.drag-area').toggleClass("visible");
		$('#btn-save').toggleClass("visible");
	});
	
</script>
<style>
	
</style>

@endsection

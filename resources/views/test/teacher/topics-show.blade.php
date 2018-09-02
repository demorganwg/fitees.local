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
			<h3>{{ $topic['name'] }}</h3>
			<a class="btn btn-icon" href="{{ route('teacher.topics.edit', ['course_alias' => $course['alias'], 'topic' => $topic['alias']]) }}">Редактировать</a>
			<p>{{ $topic['description'] }}</p>
			<h3>Список страниц</h3>
			<a class="btn btn-icon" href="{{ route('teacher.pages.create', ['course_alias' => $course['alias'], 'topic' => $topic['alias']]) }}">Создать страницу</a>
			<button id="btn-order" class="btn btn-icon">Изменить порядок</button>
			<form class="list_wrap" method="POST" action="{{ action('Teacher\TopicController@changePagePosition', ['course_alias' => $course['alias'], 'topic' => $topic['alias']]) }}">
				@csrf	
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
				<button type="submit" id="btn-save" class="btn btn-icon">Сохранить изменения</button>
			</form>
		</div>
	</div>	
</div>
<script>
	$('.drag-list li').arrangeable({dragSelector: '.drag-area'});
	
	$('#btn-order').on("click", function() {
		$(this).toggleClass("active");
		$('.drag-area').toggleClass("visible");
		$('#btn-save').toggleClass("visible");
	});
	
</script>
<style>
	#btn-save {
		display: none
	}
	#btn-save.visible {
		display: block;
		margin: 10px 0;
	}
	#btn-order {
		transition: .2s all ease;
	}
	#btn-order.active {
		background-color: #b3e5fc;
		color: #fff;
	}
	.drag-numbers, 
	.drag-list {
		display: inline-block;
		list-style-type: none;
		margin: 0;
		padding: 0;
		user-select: none;
	}
	.drag-numbers >li,
	.drag-list >li {
		margin: 5px 0;
		font-size: 24px;
		height: 40px;
		border: 1px solid #b3e5fc;
	}
	.drag-numbers >li {
		text-align: center;
		padding: 0 10px;
	}
	.drag-list >li {
		width: 500px;
		padding-left: 10px;
	}
	.drag-list .drag-area {
		background-color: #b3e5fc;
		width: 60px;
		height: 38px;
		vertical-align: top;
		float: right;
		cursor: move;
		display: none;
	}
	.drag-list .drag-area.visible {
		display: inline-block;
	}
	
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

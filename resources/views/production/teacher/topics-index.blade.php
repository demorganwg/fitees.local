@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/jquery-dragarrange/drag-arrange.min.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section">
	<h2>Темы курса {{ $course['name'] }} </h2>
	<button id="btn-order" class="btn btn-icon">Изменить порядок</button>
	<form method="POST" action="{{ action('Teacher\TopicController@changeTopicPosition', ['course_alias' => $course['alias']]) }}">
		@csrf
		<table class="table table-striped table-hover drag-list" style="margin: 20px 0">
			<tr>
				<th style="width: 220px">Имя</th>
				<td>Редактировать</td>
				<th>Псевдоним</th>
				<th>Описание</th>
				<th>Отредактирована</th>
				<th>Создана</th>
			</tr>
			@foreach ($courseTopics as $n => $topic)
			<tr class="draggable">
				<td style="width: 220px">
					<a href="{{ route('teacher.topics.show', ['course_alias' => $course['alias'], 'topic' => $topic['alias']])}}">{{ $topic['name'] }}</a>
					<span class="drag-area"><i class="icon icon-apps"></i></span>
					<input type="hidden" name="old-number-{{ $topic['number'] }}" value="{{ $topic['id'] }}">
				</td>
				<td><a class="edit" href="{{ route('teacher.topics.edit', ['course_alias' => $course['alias'], 'topic' => $topic['alias']])}}"><i class="icon icon-edit"></i></a></td>
				<td>{{ $topic['alias'] }}</td>
				<td>{{ $topic['description'] }}</td>
				<td>{{ $topic['updated_at'] }}</td>
				<td>{{ $topic['created_at'] }}</td>
			</tr>
			@endforeach
		</table>
		<button type="submit" id="btn-save" class="btn btn-lg btn-primary">Сохранить изменения</button>
	</form>
	<a class="btn btn-lg" href="{{ route('teacher.topics.create', ['course_alias' => $course['alias']])}}" style="margin-top: 20px">Добавить тему</a>
</section>
<script>
	$('.drag-list tr.draggable').arrangeable({dragSelector: '.drag-area'});
	
	$('#btn-order').on("click", function() {
		$(this).toggleClass("active");
		$('.drag-area').toggleClass("visible");
		$('#btn-save').toggleClass("visible");
	});
	
</script>
@endsection

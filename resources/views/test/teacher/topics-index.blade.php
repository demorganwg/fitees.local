@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/jquery-dragarrange/drag-arrange.min.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<h2>Темы курса {{ $course['name'] }} </h2>
	<button id="btn-order" class="btn btn-icon">Изменить порядок</button>
	<form method="POST" action="{{ action('Teacher\TopicController@changeTopicPosition', ['course_alias' => $course['alias']]) }}">
		@csrf
		<div class="tables_wrap">
		<table class="drag-numbers">
			<tr>
				<th>№</th>
			</tr>
			@foreach ($courseTopics as $n => $topic)
				<tr>
					<td>{{ $n+1 }}</td>
				</tr>
			@endforeach
		</table>
		<table class="drag-list">
			<tr>
				<th>Имя</th>
				<td>Редактировать</td>
				<th>Псевдоним</th>
				<th>Описание</th>
				<th>Отредактирована</th>
				<th>Создана</th>
			</tr>
			@foreach ($courseTopics as $n => $topic)
			<tr class="draggable">
				<td>
					<a href="{{ route('teacher.topics.show', ['course_alias' => $course['alias'], 'topic' => $topic['alias']])}}">{{ $topic['name'] }}</a>
					<span class="drag-area"></span>
					<input type="hidden" name="old-number-{{ $topic['number'] }}" value="{{ $topic['id'] }}">
				</td>
				<td><a class="edit" href="{{ route('teacher.topics.edit', ['course_alias' => $course['alias'], 'topic' => $topic['alias']])}}">edit</a></td>
				<td>{{ $topic['alias'] }}</td>
				<td>{{ $topic['description'] }}</td>
				<td>{{ $topic['updated_at'] }}</td>
				<td>{{ $topic['created_at'] }}</td>
			</tr>
			@endforeach
		</table>
		</div>
		<button type="submit" id="btn-save" class="btn btn-icon">Сохранить изменения</button>
	</form>
	<a class="btn" href="{{ route('teacher.topics.create', ['course_alias' => $course['alias']])}}">Добавить тему</a>
</div>
<script>
	$('.drag-list tr.draggable').arrangeable({dragSelector: '.drag-area'});
	
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
		margin: 20px 0;
	}
	#btn-order {
		transition: .2s all ease;
		margin-bottom: 20px;
	}
	#btn-order.active {
		background-color: #b3e5fc;
		color: #fff;
	}
	.tables_wrap {
		display: flex;
	}
	.drag-numbers, 
	.drag-list {
		user-select: none;
	}
	.drag-numbers {
		width: 30px;
	}
	.drag-list .drag-area {
		background-color: #b3e5fc;
		width: 40px;
		height: 26px;
		vertical-align: top;
		float: right;
		cursor: move;
		margin-left: 20px;
		display: none;
	}
	.drag-list .drag-area.visible {
		display: inline-block;
	}
	table {
		width: 100%;
	}
	table th, table td {
		border: 1px solid #b3e5fc;
		padding: 2px 5px;
	}
	.edit {
		display: block;
		text-align: center;
		color: #000;
		width: 70px;
		height: 20px;
		background-color: #b3e5fc; 
	}
</style>
@endsection

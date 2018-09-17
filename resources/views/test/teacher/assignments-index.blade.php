@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/jquery-dragarrange/drag-arrange.min.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<h2>Задания курса {{ $course['name'] }} </h2>
	<button id="btn-order" class="btn btn-icon">Изменить порядок</button>
	<form method="POST" action="{{ action('Teacher\AssignmentController@changeAssignmentPosition', ['course_alias' => $course['alias']]) }}">
		@csrf
		<div class="tables_wrap">
		<table class="drag-numbers">
			<tr>
				<th>№</th>
			</tr>
			@foreach ($courseAssignments as $n => $assignments)
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
				<th>Отредактирован</th>
				<th>Создан</th>
			</tr>
			@foreach ($courseAssignments as $n => $assignment)
			<tr class="draggable">
				<td>
					<a href="{{ route('teacher.assignments.show', ['course_alias' => $course['alias'], 'assignment' => $assignment['alias']])}}">{{ $assignment['name'] }}</a>
					<span class="drag-area"></span>
					<input type="hidden" name="old-number-{{ $assignment['number'] }}" value="{{ $assignment['id'] }}">
				</td>
				<td><a class="edit" href="{{ route('teacher.assignments.edit', ['course_alias' => $course['alias'], 'assignment' => $assignment['alias']])}}">edit</a></td>
				<td>{{ $assignment['alias'] }}</td>
				<td>{{ $assignment['description'] }}</td>
				<td>{{ $assignment['updated_at'] }}</td>
				<td>{{ $assignment['created_at'] }}</td>
			</tr>
			@endforeach
		</table>
		</div>
		<button type="submit" id="btn-save" class="btn btn-icon">Сохранить изменения</button>
	</form>
	<a class="btn" href="{{ route('teacher.assignments.create', ['course_alias' => $course['alias']])}}">Добавить задание</a>
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

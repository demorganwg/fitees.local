@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/jquery-dragarrange/drag-arrange.min.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section">
	<h2>Задания курса {{ $course['name'] }} </h2>
	<button id="btn-order" class="btn btn-lg">Изменить порядок</button>
	<form method="POST" action="{{ action('Teacher\AssignmentController@changeAssignmentPosition', ['course_alias' => $course['alias']]) }}" style="margin: 20px 0">
		@csrf
		<table class="table table-striped table-hover drag-list">
			<tr>
				<th>Имя</th>
				<td>Редактировать</td>
				<th>Псевдоним</th>
				<th class="nowrap">Описание</th>
				<th>Отредактирован</th>
				<th>Создан</th>
			</tr>
			@foreach ($courseAssignments as $n => $assignment)
			<tr class="draggable">
				<td>
					<a href="{{ route('teacher.assignments.show', ['course_alias' => $course['alias'], 'assignment' => $assignment['alias']])}}">{{ $assignment['name'] }}</a>
					<span class="drag-area"><i class="icon icon-apps"></i></span>
					<input type="hidden" name="old-number-{{ $assignment['number'] }}" value="{{ $assignment['id'] }}">
				</td>
				<td><a class="edit" href="{{ route('teacher.assignments.edit', ['course_alias' => $course['alias'], 'assignment' => $assignment['alias']])}}"><i class="icon icon-edit"></i></a></td>
				<td>{{ $assignment['alias'] }}</td>
				<td class="nowrap">{{ $assignment['description'] }}</td>
				<td>{{ $assignment['updated_at'] }}</td>
				<td>{{ $assignment['created_at'] }}</td>
			</tr>
			@endforeach
		</table>
		<button type="submit" id="btn-save" class="btn btn-lg btn-primary">Сохранить изменения</button>
	</form>
	<a class="btn btn-lg btn-primary" href="{{ route('teacher.assignments.create', ['course_alias' => $course['alias']])}}">Добавить задание</a>
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

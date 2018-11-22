@extends (env('THEME').'.layouts.teacher')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section">
	<h2>{{ $course['name'] }}</h2>
	<h3>Пригласить группу</h3>
	<form method="POST" action="{{ action('Teacher\StudentsController@inviteGroup', ['course_alias' => $course['alias']]) }}">
		@csrf
		<div class="form-group">
			<label for="group">Группа: </label>
			<select class="form-select" name="group_id" style="width: 350px">
			@foreach ($groups as $group)
				<option value="{{ $group['id'] }}">{{ $group['name'] }}</option>
			@endforeach
			</select>
		</div>
		<button type="submit" class="btn btn-lg btn-primary">Пригласить</button>
	</form>
</section>
<section class="content_section">
	@foreach ($groups as $group)
		@if ($group['active'] == 1)
		<h4>{{ $group['name'] }}</h4>
		<table class="table table-striped table-hover">
			<tr>
				<th>№</th>
				<th>Студент</th>
				<th>E-mail</th>
				<th>Статус</th>
				<th>Результат</th>
				<th>Действия</th>
			</tr>
			@foreach ($group['students'] as $n => $student)
			<tr>
				<td>{{ $n+1 }}</td>
				<td>
				@if ($student['status'] == 'Активен' || $student['status'] == 'Завершил')
					<a href="{{ route('course.show.student', ['course_alias' => $course['alias'], 'student_id' => $student['id']]) }}">{{ $student['name'].' '.$student['surname'] }}</a>
				@else
					{{ $student['name'].' '.$student['surname'] }}
				@endif
				</td>
				<td><a href="mailto:{{ $student['email'] }}">{{ $student['email'] }}</a>
				</td>
				<td>{{ $student['status'] }}</td>
				<td>{{ $student['score'] }}</td>
				<td>
				@if ($student['status'] == 'Не участвует')
				<form method="POST" action="{{ action('Teacher\StudentsController@inviteStudent', ['course_alias' => $course['alias']]) }}">
					@csrf
					<input type="hidden" name="student_id" value="{{ $student['id'] }}"/>
					<button type="submit" class="btn btn-sm">Пригласить</button>
				</form>
				@endif
				@if ($student['status'] == 'Активен')
				<form method="POST" action="{{ action('Teacher\StudentsController@graduateStudent', ['course_alias' => $course['alias']]) }}">
					@csrf
					<input type="hidden" name="student_id" value="{{ $student['id'] }}"/>
					<button type="submit" class="btn btn-sm">Выпустить</button>
				</form>
				@endif
				@if ($student['status'] == 'Ожидает')
				<form method="POST" action="{{ action('Teacher\StudentsController@submitStudent', ['course_alias' => $course['alias']]) }}">
					@csrf
					<input type="hidden" name="student_id" value="{{ $student['id'] }}"/>
					<button type="submit" class="btn btn-sm">Активировать</button>
				</form>
				<form method="POST" action="{{ action('Teacher\StudentsController@declineStudent', ['course_alias' => $course['alias']]) }}">
					@csrf
					<input type="hidden" name="student_id" value="{{ $student['id'] }}"/>
					<button type="submit" class="btn btn-sm">Отклонить</button>
				</form>
				@endif
				@if ($student['status'] == 'Завершил')
				Красавчик
				@endif
				</td>
			</tr>
			@endforeach
		</table>
		@endif
	@endforeach	
</section>
@endsection

@extends (env('THEME').'.layouts.teacher')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<div class="container">
		<div class="course_page">
			<h2>{{ $course['name'] }}</h2>
			
			<h3>Пригласить группу</h3>
			<form method="POST" action="{{ action('Teacher\StudentsController@inviteGroup', ['course_alias' => $course['alias']]) }}">
				@csrf
				<formgroup>
					<label for="group">Группа: </label>
					<select name="group_id">				
					@foreach ($groups as $group)
						<option value="{{ $group['id'] }}">{{ $group['name'] }}</option>
					@endforeach
					</select>
				</formgroup>
				<button type="submit" class="btn btn-send">Пригласить</button>
			</form>
			
			
			@foreach ($groups as $group)
				@if ($group['active'] == 1)
				<h4>{{ $group['name'] }}</h4>
				<table>
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
							<button type="submit" class="btn btn-icon">Пригласить</button>
						</form>
						@endif
						@if ($student['status'] == 'Активен')
						<form method="POST" action="{{ action('Teacher\StudentsController@graduateStudent', ['course_alias' => $course['alias']]) }}">
							@csrf
							<input type="hidden" name="student_id" value="{{ $student['id'] }}"/>
							<button type="submit" class="btn btn-icon">Выпустить</button>
						</form>
						@endif
						@if ($student['status'] == 'Ожидает')
						<form method="POST" action="{{ action('Teacher\StudentsController@submitStudent', ['course_alias' => $course['alias']]) }}">
							@csrf
							<input type="hidden" name="student_id" value="{{ $student['id'] }}"/>
							<button type="submit" class="btn btn-icon">Активировать</button>
						</form>
						<form method="POST" action="{{ action('Teacher\StudentsController@declineStudent', ['course_alias' => $course['alias']]) }}">
							@csrf
							<input type="hidden" name="student_id" value="{{ $student['id'] }}"/>
							<button type="submit" class="btn btn-icon">Отклонить</button>
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
			
			
		</div>
	</div>	
</div>
<style>
	h3 {
		margin-top: 40px;
	}
	table {
		width: 100%;
		margin-bottom: 20px;
	}
	
	table th, td {
		border: 1px solid silver;
		padding: 3px 5px;
		text-align: center;
	}
	table th {
		text-align: center;
	}
	.btn-icon {
		margin: 5px auto;
		width: 150px;
	}
	.btn-send {
		margin: 10px 0 50px;
	}
</style>
@endsection

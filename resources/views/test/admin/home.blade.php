@extends (env('THEME').'.layouts.admin')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<h2>Панель управления Админа</h2>
	<h3>Неактивные курсы</h3>
	<div class="courses_wrap row">
	@if($coursesNotActive->isNotEmpty())
		@foreach ($coursesNotActive as $course)
			<div class="course_item col-3">
				<img src="{{ asset('assets') }}/img/course_img/{{ $course['image'] }}" alt="{{ $course['name'] }}">
				<a href="{!! url('/admin/courses/'.$course['alias']); !!}"><h3>{{ $course['name'] }}</h3></a>
				{!! $course['description'] !!}
			</div>
		@endforeach
	@else
		<p>Сейчас нет неактивных курсов</p>
	@endif
	</div>
	<h3>Активные курсы</h3>
	<div class="courses_wrap row">
	@if($coursesActive->isNotEmpty())
		@foreach ($coursesActive as $course)
			<div class="course_item col-3">
				<img src="{{ asset('assets') }}/img/course_img/{{ $course['image'] }}" alt="{{ $course['name'] }}">
				<a href="{!! url('/admin/courses/'.$course['alias']); !!}"><h3>{{ $course['name'] }}</h3></a>
				{!! $course['description'] !!}
			</div>
		@endforeach
	@else
		<p>Сейчас нет активных курсов</p>
	@endif
	</div>
	<h3>Верифицировать студентов</h3>
	<form method="POST" class="verify-users" action="{{ action('Admin\HomeController@verifyUsers') }}">
		@csrf
		<div class="tables_wrap">
		<table>
			<tr>
				<th>№</th>
				<th>Имя</th>
				<td>Фамилия</td>
				<th>Email</th>
				<th>Группа</th>
				<th>Дата регистрации</th>
				<th>Верифицировать</th>
				<th>Удалить</th>
			</tr>
			@foreach ($users as $n => $user)
			<tr>
				<td>{{ $n+1 }}</td>
				<td>{{ $user['name'] }}</td>
				<td>{{ $user['surname'] }}</td>
				<td>{{ $user['email'] }}</td>
				<td>{{ $user['group'] }}</td>
				<td>{{ $user['register_date'] }}</td>
				<td>
					<input type="checkbox" class="verify" id="verify-{{ $user['id'] }}" name="verify-{{ $user['id'] }}">
				</td>
				<td>
					<input type="checkbox" class="delete" id="delete-{{ $user['id'] }}" name="delete-{{ $user['id'] }}">
				</td>
			</tr>
			@endforeach
		</table>
		</div>
		<label for="verify-all" class="btn btn-icon"><input type="checkbox" id="verify-all" name="verify-all"> Верифицировать всех</label>
		<label for="delete-all" class="btn btn-icon"><input type="checkbox" id="delete-all" name="delete-all"> Удалить всех</label>
		<button type="submit" id="btn-save" class="btn btn-icon">Применить действия</button>
	</form>
	<h3>Группы</h3>
	<form method="POST" action="{{ route('admin.groups.store') }}"  enctype="multipart/form-data">
		@csrf
		<div class="error-messages">
			@if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
		</div>
		<formgroup>
			<label for="name">Название *</label>
			<input type="text" id="name" name="name" value="{{ old('name') }}" required>
		</formgroup>
		<button type="submit" class="btn btn-send">Создать группу</button>
	</form>
	<ul>
		@foreach ($groups as $n => $group)
			<li class="btn btn-icon"><a href="{{ route('admin.groups.edit', ['id' => $group['id']]) }}">{{ $group['name'] }}</a></li>
		@endforeach
	</ul>
	<h3>Преподаватели</h3>
	<a href="{{ action('Admin\RegisterController@showTeacherRegistrationForm') }}" class="btn btn-icon">Добавить преподавателя</a>
	<div class="tables_wrap">
		<table>
			<tr>
				<th>№</th>
				<th>Имя</th>
				<td>Фамилия</td>
				<th>Email</th>
				<th>Дата регистрации</th>
			</tr>
			@foreach ($teachers as $n => $teacher)
			<tr>
				<td>{{ $n+1 }}</td>
				<td>{{ $teacher['name'] }}</td>
				<td>{{ $teacher['surname'] }}</td>
				<td>{{ $teacher['email'] }}</td>
				<td>{{ $teacher['register_date'] }}</td>
			</tr>
			@endforeach
		</table>
	</div>
</div>

<style>
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
	.verify-users label {
		user-select: none;
		margin: 30px auto;
	}
	.btn.btn-icon {
		display: inline-block;
		margin: 30px auto;
	}
	ul {
		list-style-type: none;
	}
	ul li {
		display: inline-block;
	}
</style>
<script>

	$('#verify-all').on("click", function() {
		$('input:checkbox.verify ').not(this).prop('checked', this.checked);
	});
	$('#delete-all').on("click", function() {
		$('input:checkbox.delete ').not(this).prop('checked', this.checked);
	});
</script>
@endsection

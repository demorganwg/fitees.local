@extends (env('THEME').'.layouts.admin')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section">
	<h2>Панель управления Админа</h2>
	<h3>Неактивные курсы</h3>
	<div class="courses_wrap">
	@if($coursesNotActive->isNotEmpty())
		@foreach ($coursesNotActive as $course)
			<div class="course">
				<img src="{{ asset('assets') }}/img/course_img/{{ $course['image'] }}" alt="{{ $course['name'] }}">
				<a href="{!! url('/admin/courses/'.$course['alias']); !!}">{{ $course['name'] }}</a>
				<p>{!! $course['description'] !!}</p>
			</div>
		@endforeach
	@else
		<p>Сейчас нет неактивных курсов</p>
	@endif
	</div>
</section>
<section class="content_section">
	<h3>Активные курсы</h3>
	<div class="courses_wrap">
	@if($coursesActive->isNotEmpty())
		@foreach ($coursesActive as $course)
			<div class="course">
				<img src="{{ asset('assets') }}/img/course_img/{{ $course['image'] }}" alt="{{ $course['name'] }}">
				<a href="{!! url('/admin/courses/'.$course['alias']); !!}">{{ $course['name'] }}</a>
				<p>{!! $course['description'] !!}</p>
			</div>
		@endforeach
	@else
		<p>Сейчас нет активных курсов</p>
	@endif
	</div>
</section>
<section class="content_section">
	<h3>Верифицировать студентов</h3>
	<form method="POST" class="verify-users" action="{{ action('Admin\HomeController@verifyUsers') }}">
		@csrf
		<table class="table table-striped table-hover">
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
					<div class="form-group">
						<label class="form-checkbox">
							<input class="form-input" type="checkbox" class="verify" id="verify-{{ $user['id'] }}" name="verify-{{ $user['id'] }}">
							<i class="form-icon"></i>
						</label>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="form-checkbox">
							<input class="form-input" type="checkbox" class="delete" id="delete-{{ $user['id'] }}" name="delete-{{ $user['id'] }}">
							<i class="form-icon"></i>
						</label>
					</div>
				</td>
			</tr>
			@endforeach
		</table>
		<label for="verify-all" class="btn btn-lg"><input type="checkbox" id="verify-all" name="verify-all"> Верифицировать всех</label>
		<label for="delete-all" class="btn btn-lg"><input type="checkbox" id="delete-all" name="delete-all"> Удалить всех</label>
		<button type="submit" id="btn-save" class="btn btn-lg btn-primary">Применить действия</button>
	</form>
</section>
<section class="content_section">
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
		<div class="form-group">
			<label class="form-label" for="name">Название *</label>
			<input class="form-input" type="text" id="name" name="name" value="{{ old('name') }}" required style="width: 350px">
		</div>
		<button type="submit" class="btn btn-lg btn-primary">Создать группу</button>
	</form>
	<ul>
		@foreach ($groups as $n => $group)
			<li class="btn"><a href="{{ route('admin.groups.edit', ['id' => $group['id']]) }}">{{ $group['name'] }}</a></li>
		@endforeach
	</ul>
</section>
<section class="content_section">
	<h3>Преподаватели</h3>
	<a href="{{ action('Admin\RegisterController@showTeacherRegistrationForm') }}" class="btn btn-lg btn-primary" style="margin-bottom: 20px">Добавить преподавателя</a>
	<table class="table table-striped table-hover">
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
</section>

<!-- <style>
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
</style> -->
<script>
	$('#verify-all').on("click", function() {
		$('input:checkbox.verify ').not(this).prop('checked', this.checked);
	});
	$('#delete-all').on("click", function() {
		$('input:checkbox.delete ').not(this).prop('checked', this.checked);
	});
</script>
@endsection

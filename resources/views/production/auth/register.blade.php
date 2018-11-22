@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="form_container">
	<h2>Регистрация</h2>
	<form method="POST" action="{{ route('register') }}">
		@csrf
		<div class="form-group">
			<label class="form-label" for="name">Имя</label>
			<input class="form-input" type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
			@if ($errors->has('name'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
				@endif
		</div>
		<div class="form-group">
			<label class="form-label" for="surname">Фамилия</label>
			<input class="form-input" type="text" id="surname" name="surname" value="{{ old('surname') }}" required>
			@if ($errors->has('surname'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('surname') }}</strong>
						</span>
				@endif
		</div>
		<div class="form-group">
			<label class="form-label" for="group">Группа</label>
			<select class="form-select" name="group_id">				
			@foreach ($groups as $group)
				<option value="{{ $group['id'] }}">{{ $group['name'] }}</option>
			@endforeach
			</select>
		</div>
		<div class="form-group">
			<label class="form-label" for="email">E-mail</label>
			<input class="form-input" type="text" id="email" name="email" value="{{ old('email') }}" required>
			@if ($errors->has('email'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
					@endif
		</div>
		<div class="form-group">
			<label class="form-label" for="password">Пароль</label>
			<input class="form-input" type="password" id="password" name="password" required>
			@if ($errors->has('password'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif
		</div>
		<div class="form-group">
			<label class="form-label" for="password_confirmation">Подтвердите пароль</label>
			<input class="form-input" type="password" id="password_confirmation" name="password_confirmation" required>
		</div>
		<button type="submit" class="btn btn-primary btn-lg btn-block">Зарегистрироваться</button>
		<a class="btn btn-lg" href="{{ route('login') }}">Войти</a>
	</form>
</div>
@endsection




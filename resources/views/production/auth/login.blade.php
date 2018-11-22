@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="form_container">
	<h2>Авторизация</h2>
	<form method="POST" action="{{ route('login') }}">
		@csrf
		<div class="form-group">
			<label class="form-label" for="email">E-mail</label>
			<input class="form-input" type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
			@if ($errors->has('email'))
				<span class="invalid-feedback" role="alert">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
			@endif
		</div>
		<div class="form-group">
			<label class="form-label" for="password">Пароль</label>
			<input class="form-input" type="password" id="password" name="password" value="" required>
			@if ($errors->has('password'))
				<span class="invalid-feedback" role="alert">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
			@endif
		</div>
		<div class="form-group">
			<label class="form-checkbox">
				<input id="remember" name="remember" value="" type="checkbox" {{ old('remember') ? 'checked' : '' }}/> 
				<i class="form-icon"></i> Запомнить меня
			</label>
		</div>
		<button type="submit" class="btn btn-primary btn-lg btn-block">Войти</button>
		<a class="btn btn-lg" href="{{ route('password.request') }}">{{ __('Забыли пароль?') }}</a>
		<a class="btn btn-lg" href="{{ route('register') }}">Регистрация</a>
	</form>
</div>
@endsection

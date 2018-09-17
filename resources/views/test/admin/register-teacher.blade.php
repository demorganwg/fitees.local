@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<div class="form_container">
		<h2>Регистрация</h2>
		<form method="POST" action="{{ action('Admin\RegisterController@registerTeacher') }}">
			@csrf
			<formgroup>
				<label for="name">Имя</label>
				<input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
				@if ($errors->has('name'))
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $errors->first('name') }}</strong>
	                </span>
	            @endif
			</formgroup>
			<formgroup>
				<label for="surname">Фамилия</label>
				<input type="text" id="surname" name="surname" value="{{ old('surname') }}" required>
				@if ($errors->has('surname'))
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $errors->first('surname') }}</strong>
	                </span>
	            @endif
			</formgroup>
			<formgroup>
				<label for="email">E-mail</label>
				<input type="text" id="email" name="email" value="{{ old('email') }}" required>
				@if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
			</formgroup>
			<formgroup>
				<label for="password">Пароль</label>
				<input type="password" id="password" name="password" required>
				@if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
			</formgroup>
			<formgroup>
				<label for="password_confirmation">Подтвердите пароль</label>
				<input type="password" id="password_confirmation" name="password_confirmation" required>
			</formgroup>
			<button type="submit" class="btn btn-send">Зарегистрироваться</button>
			<a class="btn btn-link" href="{{ route('login') }}">Войти</a>
		</form>
	</div>
</div>
@endsection




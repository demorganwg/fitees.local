@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<div class="form_container">
		<h2>Авторизация</h2>
		<form method="POST" action="{{ route('login') }}">
			@csrf
			<formgroup>
				<label for="email">E-mail</label>
				<input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
			</formgroup>
			<formgroup>
				<label for="password">Пароль</label>
				<input type="password" id="password" name="password" value="" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
			</formgroup>
			<formgroup>
				<label for="rememberme">Remember me</label>  
				<input id="remember" name="remember" value="" type="checkbox" {{ old('remember') ? 'checked' : '' }}/> 
			</formgroup>
			<button type="submit" class="btn btn-send">Войти</button>
            <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Забыли пароль?') }}</a>
		</form>
	</div>
</div>
@endsection

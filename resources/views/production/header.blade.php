<header class="main_header">
	<a href="{{ route('index') }}" class="logo">
		<img src="{{ asset(env('THEME')) }}/img/ees_logo.svg" alt="EES Fit">
		<h1>EES Fit</h1>
	</a>
	<nav class="navbar">
		<ul class="navbar_menu">
			<li><a href="{{ route('courses') }}">Все курсы</a></li>
			@if (Auth::check())
				@if (Auth::user()->hasRole('Unknown'))
					<li><a href="{{ route('learn') }}">Мои курсы</a></li>
				@elseif (Auth::user()->hasRole('Student'))
					<li><a href="{{ route('learn') }}">Мои курсы</a></li>
				@elseif (Auth::user()->hasRole('Teacher'))
					<li><a href="{{ route('teacher.courses.index') }}">Мои курсы</a></li>
				@elseif (Auth::user()->hasRole('Admin'))
					<li><a href="{{ route('admin') }}">Панель управления</a></li>
				@endif
				<li><a href="{{ route('logout') }}">Выход</a></li>
			@endif
		</ul>
		@if (!Auth::user())
			<div class="auth_menu">
				<a class="btn btn-primary btn-lg" href="{{ route('login') }}">Войти</a>
				<a class="btn btn-lg" href="{{ route('register') }}">Зарегистрироваться</a>
			</div>
		@endif
	</nav>
</header>
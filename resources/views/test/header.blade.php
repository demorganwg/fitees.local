<header class="main_header">
	<div class="row">
		<div class="col-6">
			<a href="{{ route('index') }}" class="logo_container">
				<img src="{{ asset(env('THEME')) }}/img/fitees_logo_2.png" alt="Alt">
				<h1>FITees Project</h1>
			</a>
		</div>
		<div class="col-6">
			<ul class="menu">
				<li><a href="{{ route('courses') }}">Все курсы</a></li>
				@if (Auth::check())
					@if (Auth::user()->hasRole('Unknown'))
						<li><a href="{{ route('home') }}">Домой</a></li>
					@endif
					@if (Auth::user()->hasRole('Student'))
						<li><a href="{{ route('home') }}">Домой</a></li>
						<li><a href="#">Мои курсы</a></li>
					@endif
					@if (Auth::user()->hasRole('Teacher'))
						<li><a href="{{ route('teacher') }}">Домой</a></li>
						<li><a href="#">Мои курсы</a></li>
						<li><a href="#">Создать курс</a></li>
					@endif		
					@if (Auth::user()->hasRole('Admin'))
						<li><a href="{{ route('admin') }}">Домой</a></li>
						<li><a href="#">Создать курс</a></li>
						<li><a href="#">Все курсы</a></li>
					@endif
					<li><a href="#">Аккаунт</a></li>
					<li><a href="{{ route('logout') }}">Выход</a></li>
				@endif
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			@if (Auth::check())
				<ul class="user-data">
					<li><strong>Id:</strong> {{ Auth::user()->id }}</li>
					<li><strong>Имя:</strong> {{ Auth::user()->name }}</li>
					<li><strong>Фамилия:</strong> {{ Auth::user()->surname }}</li>
					<li><strong>Статус:</strong> {{ Auth::user()->status }}</li>
					<li><strong>Роль:</strong> {{ Auth::user()->roles->name }}</li>
				</ul>
			@endif
			<style>
				.user-data {
					list-style-type: none;
					padding-top: 25px;
					border-top: 1px solid #b3e5fc;
				}
				.user-data li {
					display: inline-block;
					padding-right: 10px;
					font-size: 20px;
					margin-right: 5px;
					border-right: 1px solid #b3e5fc;
				}
			</style>
		</div>
	</div>
</header>
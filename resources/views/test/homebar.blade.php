<ul>
	@if (Auth::user()->hasRole('Student'))
		<li><a href="{{ route('learn') }}">Мои курсы</a></li>
	@endif
	
	@if (Auth::user()->hasRole('Teacher'))
		<li><a href="{{ route('teach') }}">Мои курсы</a></li>
		<li><a href="{{ route('course.add') }}">Создать курс</a></li>
	@endif	
	<li><a href ="#">Настройки</a></li>
	<li><a href ="#">Аккаунт</a></li>
</ul>
<style>
	.homebar {
		height: 100%;
		min-height: 1000px;
		border-right: 1px solid #b3e5fc;
	}
	.homebar ul {
		margin-top: 50px;
		list-style-type: none;
	}
	.homebar ul li {
		margin-top: 10px;
		font-size: 24px;
	}
	.homebar ul li a {
		text-decoration: none;
	}
</style>
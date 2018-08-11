@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
	<div class="homebar col-2">
		{!! $homebar !!}
	</div>

	<div class="content col-10">
		@if (Auth::user()->hasRole('Unknown'))
			<h2>Страница HOME неподтвержденного пользователя</h2>
			<p>Ожидайте подтверждения от администратора</p>
		@endif
		@if (Auth::user()->hasRole('Student'))
			<h2>Страница HOME Студента</h2>
			<p>Всё ОК ;)</p>
		@endif
	</div>
@endsection

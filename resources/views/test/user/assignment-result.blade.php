@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')

<div class="content col-12">
	<div class="container">
		<h2>Правильных ответов: {{ $userResults['userRightAnswers'] }} из {{ $userResults['rightAnswerMax'] }}</h2>
		<h2>Результаты тестирования: {{ number_format($userResults['userScore'], 0) }} из {{ number_format($userResults['maxScore'], 0) }}</h2>
	</div>	
</div>
<style>
	
</style>
@endsection

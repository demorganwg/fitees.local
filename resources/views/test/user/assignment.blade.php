@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')

<div class="col-2">
	{!! $assignmentNavigation !!}
</div>
<div class="content col-10">
	<div class="container">
		<form method="POST" action="{!! url('/courses/'.$courseAlias.'/assignments/'.$assignmentAlias); !!}">
			@csrf
			@foreach ($assignmentQuestions as $q => $question)
				<div class="question_container" id="question-{{ $question['number'] }}">
					<div class="question">
						<h3>Вопрос №{{ $question['number'] }}</h3>
						<p>{{ $question['content'] }}</p>
					</div>
					<formgroup>
						<div class="answer">		
							<ul>
								@foreach ($question['answers'] as $a => $answer)
									<li>
										<input type="checkbox" name="question[q{{ $q+1 }}][a{{ $a+1 }}]">
										<label>{{ $answer['content'] }}</label>
									</li>
								@endforeach
							</ul>
						</div>
					</formgroup>
				</div>
			@endforeach
			<button type="submit" class="btn btn-send">Завершить тестирование</button>
		</form>
	</div>	
</div>
<style>
	.question_container {
		border-bottom: 1px solid #b3e5fc;
		margin-bottom: 30px;
	}
	.question_container .answer ul {
		list-style-type: none;
	} 
	
	.question_container .answer ul li {
		
	} 
</style>
@endsection

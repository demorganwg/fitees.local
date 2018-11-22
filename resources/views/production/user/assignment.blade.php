@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section nav-sidebar">
	<nav class="sidebar_left">
		{!! $assignmentNavigation !!}
	</nav>
	<div class="content_container">
		<form method="POST" action="{!! url('/courses/'.$courseAlias.'/assignments/'.$assignmentAlias); !!}">
			@csrf
			@foreach ($assignmentQuestions as $q => $question)
				<div class="question_container" id="question-{{ $question['number'] }}">
					<div class="question">
						<h3>Запитання №{{ $question['number'] }}</h3>
						<p>{!! $question['content'] !!}</p>
					</div>
					<div class="form-group">
						<div class="answer">		
							<ul>
								@foreach ($question['answers'] as $a => $answer)
									<li>
										<div class="form-group">
											<label class="form-checkbox">
											<input type="checkbox" name="question[q{{ $q+1 }}][a{{ $a+1 }}]"> 
												<i class="form-icon"></i> {{ $answer['content'] }}
											</label>
										</div>
									</li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
			@endforeach
			<button type="submit" class="btn btn-lg btn-primary">Завершить тестирование</button>
		</form>
	</div>	
</section>
@endsection

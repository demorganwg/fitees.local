@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/jquery-dragarrange/drag-arrange.min.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section">
	<h3>{{ $assignment['name'] }}</h3>
	<a class="btn btn-lg btn-primary" href="{{ route('teacher.assignments.edit', ['course_alias' => $courseAlias, 'assignment' => $assignment['alias']]) }}" style="margin-bottom: 20px">Редактировать</a>
	<p>{{ $assignment['description'] }}</p>
</section>
<section class="content_section">
	<h3>Список вопросов</h3>
	<a class="btn btn-lg btn-primary" href="{{ route('teacher.questions.create', ['course_alias' => $courseAlias, 'assignment' => $assignment['alias']]) }}">Создать вопрос</a>
	<button id="btn-order" class="btn btn-lg">Изменить порядок</button>
	<form class="list_wrap" method="POST" action="{{ action('Teacher\AssignmentController@changeQuestionPosition', ['course_alias' => $courseAlias, 'assignment' => $assignment['alias']]) }}">
		@csrf	
		<div class="drag-wrap" style="margin: 15px 0">
			<ul class="drag-numbers">
				@foreach ($assignment['questions'] as $n => $question)
					<li>{{ $n+1 }}</li>
				@endforeach
				</ul>
			<ul class="drag-list">
				@foreach ($assignment['questions'] as $n => $question)
					<li>
						<a href="{{ route('teacher.questions.edit', ['course_alias' => $courseAlias, 'assignment' => $assignment['alias'], 'question' => $question['number']])}}">{{ $question['shortname'] }}</a>
						<span class="drag-area"></span>
						
						<input type="hidden" name="old-number-{{ $question['number'] }}" value="{{ $question['id'] }}">
					</li>
				@endforeach
			</ul>
		</div>
		<button type="submit" id="btn-save" class="btn btn-lg btn-primary">Сохранить изменения</button>
	</form>
</section>
<script>
	$('.drag-list li').arrangeable({dragSelector: '.drag-area'});
	$('#btn-order').on("click", function() {
		$(this).toggleClass("active");
		$('.drag-area').toggleClass("visible");
		$('#btn-save').toggleClass("visible");
	});
</script>
@endsection

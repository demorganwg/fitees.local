@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/ckeditor5-classic/ckeditor.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section section_edit">
	<h2>Редактировать вопрос</h2>
	<div class="form_container">
	
		<form method="POST" action="{{ route('teacher.questions.update', ['course' => $courseAlias, 'assignment' => $assignmentAlias, 'question' => $question['number']]) }}"  enctype="multipart/form-data">
			@method('PUT')
			@csrf
			<div class="error-messages">
				@if ($errors->has('content'))
					<span class="invalid-feedback" role="alert">
						<strong>{{ $errors->first('content') }}</strong>
					</span>
				@endif
			</div>
			<div class="form-group">
				<label class="form-label" for="content">Вопрос *</label>
				<textarea id="content" name="content">{{ $data['content'] }}</textarea>
			</div>
			<div id="add-answer" class="btn btn-lg">Добавить ответ</div>
			<div class="answers">
				@if($data['answers'])
					@foreach($data['answers'] as $n => $answer)
						<div class="form-group answer">
							<label for="answer-{{ ++$n }}">Ответ {{ $n }}</label>
							<input class="form-input" type="text" id="answer-{{ $n }}" name="answer-{{ $n }}" value="{{ $answer['content'] }}">
							@if($answer['is_correct'] == 1)
							<div class="form-group">
								<label class="form-checkbox">
									<input type="checkbox" id="is_correct-{{ $n }}" name="is_correct-{{ $n }}" checked>
									<i class="form-icon"></i>
								</label>
							</div>
							@else
							<div class="form-group">
								<label class="form-checkbox">
									<input type="checkbox" id="is_correct-{{ $n }}" name="is_correct-{{ $n }}">
									<i class="form-icon"></i>
								</label>
							</div>
							@endif
							<label for="answer-{{ $n }}">Правильный </label>
							<button type='button' class='btn btn-sm answer-del' style="margin-top: 0">Удалить</button>
						</div>
					@endforeach
				@endif
			</div>
			<button type="submit" class="btn btn-lg btn-primary">Сохранить изменения</button>
		</form>
		
		<form method="POST" action="{{ route('teacher.questions.destroy', ['course' => $courseAlias, 'assignment' => $assignmentAlias, 'question' => $question['number']]) }}" enctype="multipart/form-data">
			@method('DELETE')
			@csrf
			<button type="submit" class="btn btn-lg">Удалить вопрос</button>
		</form>
	</div>
</section>
<script>
	ClassicEditor.create(document.querySelector( '#content' )).catch( 
		error => {console.error( error );
	});
		
   $('.answer-del').on("click", function() {
			$(this).closest('.form-group.answer').remove();
	});
   
	var n = $('.answer').length;

   	$('#add-answer').on("click", function() {
   	
		$('.answers').append(
			"<div class='form-group answer'><label for='answer-" + ++n + "'>Ответ " + n +"</label><input class='form-input' type='text' id='answer-" + n + "' name='answer-" + n + "' required><div class='form-group'><label class='form-checkbox'><input type='checkbox' id='is_correct-" + n +"' name='is_correct-" + n +"'><i class='form-icon'></i></label></div><label for='answer-" + n + "'>Правильный </label><button type='button' class='btn btn-sm answer-del' style='margin-top: 0'>Удалить</button></div>"
		);
		
		$('.answer-del').on("click", function() {
			$(this).closest('.form-group.answer').remove();
		});
	});
</script>
@endsection

@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/ckeditor5-classic/ckeditor.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
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
			<formgroup>
				<label for="content">Вопрос *</label>
				<textarea id="content" name="content">{{ $data['content'] }}</textarea>
			</formgroup>
			<div id="add-answer" class="btn btn-send">Добавить ответ</div>
			<div class="answers">
				@if($data['answers'])
					@foreach($data['answers'] as $n => $answer)
						<formgroup class="answer">
							<label for="answer-{{ ++$n }}">Ответ {{ $n }}</label>
							<input type="text" id="answer-{{ $n }}" name="answer-{{ $n }}" value="{{ $answer['content'] }}">
							@if($answer['is_correct'] == 1)
								<input type="checkbox" id="is_correct-{{ $n }}" name="is_correct-{{ $n }}" checked>
							@else
								<input type="checkbox" id="is_correct-{{ $n }}" name="is_correct-{{ $n }}">
							@endif
							<label for="<label for="answer-{{ $n }}">Правильный </label>
							<button type='button' class='btn answer-del'>Удалить</button>
						</formgroup>
					@endforeach
				@endif
			</div>
			<button type="submit" class="btn btn-send">Сохранить изменения</button>
		</form>
		
		<form method="POST" action="{{ route('teacher.questions.destroy', ['course' => $courseAlias, 'assignment' => $assignmentAlias, 'question' => $question['number']]) }}" enctype="multipart/form-data">
			@method('DELETE')
			@csrf
			<p style="text-align: center">Удалить вопрос</p>
			<button type="submit" class="btn btn-send">Удалить</button>
		</form>
	</div>
</div>
<style>
	.form_container form formgroup.preview {
		margin: 30px 0;
		justify-content: center;
	}
	.image_preview {
		display: inline-block;
		height: 150px;
		width: auto;
	}
	.error-messages span {
		display: block;
		width: 100%;
		text-align: center;
		color:red;
	}
	.form_container {
		width: 950px;
	}
	.form_container form formgroup {
		display: flex;
		align-content: flex-start;
	}
	.form_container form formgroup.answer {
		align-content: center;
	}
	.form_container form formgroup.answer input[type=checkbox] {
		width: auto;
		margin: auto 20px;
	}
	.form_container form formgroup.answer label {
		text-align: left;
		line-height: 40px;
		margin: 0;
	}
	.form_container form formgroup label {
		width: 210px;
	}
	textarea {
		resize: none;
		width: 100%;
	}
	.form_container form formgroup input,
	.form_container form formgroup select {
		width: 100%;
	}
	.ck.ck-editor__main {
		height: 120px;
	}
	.ck.ck-editor {
    	width: 100%;
	}
	.ck.ck-content {
		height: 100%;
	}
	.btn.answer-del {
		margin-top: 0;
	}
</style>
<script>
	ClassicEditor.create(document.querySelector( '#content' )).catch( 
    	error => {console.error( error );
    });
    
    $('.answer-del').on("click", function() {
			$(this).closest('formgroup.answer').remove();
	});
    
    var n = $('.answer').length;

   	$('#add-answer').on("click", function() {
   	 	
		$('.answers').append(
			"<formgroup class='answer'><label for='answer-" + ++n + "'>Ответ " + n +"</label><input type='text' id='answer-" + n + "' name='answer-" + n + "' required><input type='checkbox' id='is_correct-" + n +"' name='is_correct-" + n +"'><label for='answer-" + n + "'>Правильный </label><button type='button' class='btn answer-del'>Удалить</button></formgroup>"
		);
		
		$('.answer-del').on("click", function() {
			$(this).closest('formgroup.answer').remove();
		});
	});
	
	
</script>
@endsection

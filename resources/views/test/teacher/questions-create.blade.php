@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/ckeditor5-classic/ckeditor.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<h2>Создать вопрос</h2>
	<div class="form_container">
		<form method="POST" action="{{ route('teacher.questions.store',['course_alias' => $courseAlias, 'assignment' => $assignmentAlias]) }}"  enctype="multipart/form-data">
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
				<textarea id="content" name="content" autofocus>{{ old('content') }}</textarea>
			</formgroup>
			<button type="submit" class="btn btn-send">Создать вопрос</button>
		</form>
	</div>
	
</div>
<style>
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
</style>
<script>
    ClassicEditor.create(document.querySelector( '#content' )).catch( 
    	error => {console.error( error );
    });
</script>
@endsection

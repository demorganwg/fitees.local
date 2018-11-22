@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/ckeditor5-classic/ckeditor.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section section_edit">
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
			<div class="form-group">
				<label class="form-label" for="content">Вопрос *</label>
				<textarea id="content" name="content" autofocus>{{ old('content') }}</textarea>
			</div>
			<button type="submit" class="btn btn-lg btn-primary">Создать вопрос</button>
		</form>
	</div>
</section>
<script>
	ClassicEditor.create(document.querySelector( '#content' )).catch( 
		error => {console.error( error );
	});
</script>
@endsection

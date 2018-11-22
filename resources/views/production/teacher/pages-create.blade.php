@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/ckeditor5-classic/ckeditor.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section section_edit">
	<h2>Создать страницу</h2>
	<div class="form_container">
		<form class="form-edit" method="POST" action="{{ route('teacher.pages.store',['course_alias' => $courseAlias, 'topic' => $topicAlias]) }}"  enctype="multipart/form-data">
			@csrf
			<div class="error-messages">
				@if ($errors->has('name'))
					<span class="invalid-feedback" role="alert">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
				@endif
				@if ($errors->has('number'))
					<span class="invalid-feedback" role="alert">
						<strong>{{ $errors->first('number') }}</strong>
					</span>
				@endif
			</div>
			<div class="form-group">
				<label class="form-label" for="name">Название страницы *</label>
				<input class="form-input" type="text" id="name" name="name" value="{{ old('name') }}" autofocus>
			</div>
			<div class="form-group">
				<label class="form-label" for="content">Контент страницы</label>
				<textarea id="content" name="content">{{ old('content') }}</textarea>
			</div>
			<button type="submit" class="btn btn-lg btn-primary">Создать страницу</button>
		</form>
	</div>
	
</section>
<script>
	ClassicEditor.create(document.querySelector( '#content' )).catch( 
		error => {console.error( error );
	});
</script>
@endsection

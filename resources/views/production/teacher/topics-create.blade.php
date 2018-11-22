@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/ckeditor5-classic/ckeditor.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section section_edit">
	<h2>Создать тему</h2>
	<div class="form_container">
		<form method="POST" action="{{ route('teacher.topics.store',['course_alias' => $course['alias']]) }}"  enctype="multipart/form-data">
			@csrf
			<div class="error-messages">
				@if ($errors->has('name'))
					<span class="invalid-feedback" role="alert">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
				@endif
				@if ($errors->has('alias'))
					<span class="invalid-feedback" role="alert">
						<strong>{{ $errors->first('alias') }}</strong>
					</span>
				@endif
			</div>
			<div class="form-group">
				<label class="form-label"for="name">Название темы *</label>
				<input class="form-input" type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
			</div>
			<div class="form-group">
				<label class="form-label" for="alias">Псевдоним темы *</label>
				<input class="form-input" type="text" id="alias" name="alias" value="{{ old('alias') }}" required autofocus>
			</div>
			<div class="form-group">
				<label class="form-label" for="description">Описание темы</label>
				<textarea id="description" name="description">{{ old('description') }}</textarea>
			</div>
			<button type="submit" class="btn btn-lg btn-primary">Создать тему</button>
		</form>
	</div>
</section>
<script>
	ClassicEditor.create(document.querySelector( '#description' )).catch( 
		error => {console.error( error );
	});
	ClassicEditor.create(document.querySelector( '#info' )).catch( 
		error => {console.error( error );
	});
</script>
@endsection

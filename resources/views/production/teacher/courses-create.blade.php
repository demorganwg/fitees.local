@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/ckeditor5-classic/ckeditor.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section section_edit">
	<h2>Создать курс</h2>
	<div class="form_container">
		<form class="form-edit" method="POST" action="{{ route('teacher.courses.store') }}"  enctype="multipart/form-data">
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
				<label class="form-label" for="name">Название курса *</label>
				<input class="form-input" type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
			</div>
			<div class="form-group">
				<label class="form-label" for="alias">Псевдоним курса *</label>
				<input class="form-input" type="text" id="alias" name="alias" value="{{ old('alias') }}" required autofocus>
			</div>
			<div class="form-group">
				<label class="form-label" for="description">Описание курса</label>
				<textarea id="description" name="description">{{ old('description') }}</textarea>
			</div>
			<div class="form-group">
				<label class="form-label" for="info">Информация о курсе</label>
				<textarea id="info" name="info">{{ old('info') }}</textarea>
			</div>
			<div class="form-group">
				<label class="form-label" for="image">Изображение курса</label>
				<input class="form-input" type="file" id="image" name="image">
			</div>
			<button type="submit" class="btn btn-lg btn-primary">Создать курс</button>
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

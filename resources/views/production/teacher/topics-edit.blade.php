@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/ckeditor5-classic/ckeditor.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section section_edit">
	<h2>Редактировать тему</h2>
	<div class="form_container">
		<form method="POST" action="{{ route('teacher.topics.update', ['course' => $course['alias'], 'topic' => $topic['alias']]) }}"  enctype="multipart/form-data">
			@method('PUT')
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
				<label class="form-label" for="name">Название темы *</label>
				<input class="form-input" type="text" id="name" name="name" value="{{ $data['name'] }}" required autofocus>
			</div>
			<div class="form-group">
				<label class="form-label" for="alias">Псевдоним темы *</label>
				<input class="form-input" type="alias" id="alias" name="alias" value="{{ $data['alias'] }}" required autofocus>
			</div>
			<div class="form-group">
				<label class="form-label" for="description">Описание темы</label>
				<textarea id="description" name="description">{{ $data['description'] }}</textarea>
			</div>
			<button type="submit" class="btn btn-lg btn-primary">Сохранить изменения</button>
		</form>
		<form method="POST" action="{{ route('teacher.topics.destroy', ['course' => $course['alias'], 'topic' => $topic['alias']]) }}"  enctype="multipart/form-data">
			@method('DELETE')
			@csrf
			<button type="submit" class="btn btn-lg">Удалить тему</button>
		</form>
	</div>
</section>
<script>
	ClassicEditor.create(document.querySelector( '#description' )).catch( 
		error => {console.error( error );
	});
</script>
@endsection

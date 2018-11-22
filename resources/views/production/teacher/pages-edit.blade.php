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
		<form class="form-edit" method="POST" action="{{ route('teacher.pages.update', ['course' => $courseAlias, 'topic' => $topicAlias, 'page' => $page['number']]) }}"  enctype="multipart/form-data">
			@method('PUT')
			@csrf
			<div class="error-messages">
				@if ($errors->has('name'))
					<span class="invalid-feedback" role="alert">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
				@endif
			</div>
			<div class="form-group">
				<label class="form-label" for="name">Название страницы *</label>
				<input class="form-input" type="text" id="name" name="name" value="{{ $data['name'] }}" required autofocus>
			</div>
			<div class="form-group">
				<label class="form-label" for="content">Контент страницы</label>
				<textarea id="content" name="content">{{ $data['content'] }}</textarea>
			</div>
			<button type="submit" class="btn btn-lg btn-primary">Сохранить изменения</button>
		</form>
		<form method="POST" action="{{ route('teacher.pages.destroy', ['course' => $courseAlias, 'topic' => $topicAlias, 'page' => $page['number']]) }}" enctype="multipart/form-data">
			@method('DELETE')
			@csrf
			<button type="submit" class="btn btn-lg">Удалить страницу</button>
		</form>
	</div>
</section>
<script>
	ClassicEditor.create(document.querySelector( '#content' )).catch( 
		error => {console.error( error );
	});
</script>
@endsection

@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/ckeditor5-classic/ckeditor.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section section_edit">
	<h2>Редактировать курс</h2>
	<div class="form_container">
		<form class="form-edit" method="POST" action="{{ route('teacher.courses.update', ['course' => $courseAlias]) }}"  enctype="multipart/form-data">
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
			<div class="form-group preview">
				<img class="image_preview" src="{{ asset('assets/img/course_img/'.$data['image']) }}">
				<input type="hidden" id="old_image" name="old_image" value="{{ $data['image'] }}">
			</div>
			<div class="form-group">
				<label class="form-label" for="image">Изображение курса</label>
				<input class="form-input" type="file" id="image" name="image">
			</div>
			<div class="form-group">
				<label class="form-label" for="name">Название курса *</label>
				<input class="form-input" type="text" id="name" name="name" value="{{ $data['name'] }}" required autofocus>
			</div>
			<div class="form-group">
				<label class="form-label" for="alias">Псевдоним курса *</label>
				<input class="form-input" type="alias" id="alias" name="alias" value="{{ $data['alias'] }}" required autofocus>
			</div>
			<div class="form-group">
				<label class="form-label" for="description">Описание курса</label>
				<textarea id="description" name="description">{{ $data['description'] }}</textarea>
			</div>
			<div class="form-group">
				<label class="form-label" for="info">Информация о курсе</label>
				<textarea id="info" name="info">{{ $data['info'] }}</textarea>
			</div>
			<button type="submit" class="btn btn-primary btn-lg">Сохранить изменения</button>
		</form>
		@if($data['status'] == 0)
			<form method="POST" action="{{ route('teacher.courses.destroy', ['course' => $courseAlias]) }}"  enctype="multipart/form-data">
				@method('DELETE')
				@csrf
				<p style="text-align: center">Удалить курс</p>
				<button type="submit" class="btn btn-lg">Удалить</button>
		</form>
		@else
			<p style="margin-top: 20px; text-align: center">Вы не можете удалить активный курс</p>
		@endif
		
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

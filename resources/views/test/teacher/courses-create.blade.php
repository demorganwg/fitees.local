@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/ckeditor5-classic/ckeditor.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<h2>Создать курс</h2>
	<div class="form_container">
		<form method="POST" action="{{ route('teacher.courses.store') }}"  enctype="multipart/form-data">
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
			<formgroup>
				<label for="name">Название курса *</label>
				<input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
			</formgroup>
			<formgroup>
				<label for="alias">Псевдоним курса *</label>
				<input type="text" id="alias" name="alias" value="{{ old('alias') }}" required autofocus>
			</formgroup>
			<formgroup>
				<label for="description">Описание курса</label>
				<textarea id="description" name="description">{{ old('description') }}</textarea>
			</formgroup>
			<formgroup>
				<label for="info">Информация о курсе</label>
				<textarea id="info" name="info">{{ old('info') }}</textarea>
			</formgroup>
			<formgroup>
				<label for="image">Изображение курса</label>
				<input type="file" id="image" name="image">
			</formgroup>
			
			<button type="submit" class="btn btn-send">Создать курс</button>
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
    ClassicEditor.create(document.querySelector( '#description' )).catch( 
    	error => {console.error( error );
    });
    ClassicEditor.create(document.querySelector( '#info' )).catch( 
    	error => {console.error( error );
    });
</script>
@endsection

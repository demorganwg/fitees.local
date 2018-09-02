@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/ckeditor5-classic/ckeditor.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<h2>Редактировать тему</h2>
	<div class="form_container">
	
		<form method="POST" action="{{ route('teacher.pages.update', ['course' => $courseAlias, 'topic' => $topicAlias, 'page' => $page['number']]) }}"  enctype="multipart/form-data">
			@method('PUT')
			@csrf
			<div class="error-messages">
				@if ($errors->has('name'))
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $errors->first('name') }}</strong>
	                </span>
	            @endif
			</div>
			<formgroup>
				<label for="name">Название страницы *</label>
				<input type="text" id="name" name="name" value="{{ $data['name'] }}" required autofocus>
			</formgroup>
			<formgroup>
				<label for="content">Контент страницы</label>
				<textarea id="content" name="content">{{ $data['content'] }}</textarea>
			</formgroup>
			<button type="submit" class="btn btn-send">Сохранить изменения</button>
		</form>
		
		<form method="POST" action="{{ route('teacher.pages.destroy', ['course' => $courseAlias, 'topic' => $topicAlias, 'page' => $page['number']]) }}" enctype="multipart/form-data">
			@method('DELETE')
			@csrf
			<p style="text-align: center">Удалить страницу</p>
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

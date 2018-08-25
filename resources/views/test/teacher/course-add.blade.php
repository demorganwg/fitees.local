@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<h2>Создать курс</h2>
	<div class="form_container">
		<form method="POST" action="{{ route('course.add.submit') }}">
			@csrf
			<formgroup>
				<label for="name">Название курса *</label>
				<input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
				<!--@if ($errors->has('name'))
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $errors->first('name') }}</strong>
	                </span>
	            @endif-->
			</formgroup>
			<formgroup>
				<label for="alias">Псевдоним курса *</label>
				<input type="alias" id="alias" name="alias" value="{{ old('alias') }}" required autofocus>
				<!--@if ($errors->has('alias'))
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $errors->first('alias') }}</strong>
	                </span>
	            @endif-->
			</formgroup>
			<formgroup>
				<label for="description">Описание курса</label>
				<textarea id="description" name="description" value="{{ old('description') }}"></textarea>
				<!--@if ($errors->has('description'))
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $errors->first('description') }}</strong>
	                </span>
	            @endif-->
			</formgroup>
			<formgroup>
				<label for="info">Информация о курсе</label>
				<textarea id="info" name="info" value="{{ old('info') }}"></textarea>
				<!--@if ($errors->has('info'))
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $errors->first('info') }}</strong>
	                </span>
	            @endif-->
			</formgroup>
			<formgroup>
				<label for="image">Изображение курса</label>
				<input type="file" id="image" name="image" value="{{ old('image') }}">
				<!--@if ($errors->has('image'))
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $errors->first('image') }}</strong>
	                </span>
	            @endif-->
			</formgroup>
			
			<button type="submit" class="btn btn-send">Создать курс</button>
		</form>
	</div>
	
</div>
<style>
	.form_container {
		width: 650px;
	}
	.form_container form formgroup {
		display: flex;
		align-content: flex-start;
	}
	.form_container form formgroup label {
		width: 300px;
	}
	textarea {
		resize: none;
		width: 100%;
	}
	.form_container form formgroup input,
	.form_container form formgroup select {
		width: 100%;
	}
</style>
@endsection

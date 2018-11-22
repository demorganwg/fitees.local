@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/ckeditor5-classic/ckeditor.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section section_edit">
	<h2>Создать материал</h2>
	<div class="form_container">
		<form class="form-edit" method="POST" action="{{ route('teacher.resources.store',['course_alias' => $courseAlias]) }}"  enctype="multipart/form-data">
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
				@if ($errors->has('resource_type_id'))
					<span class="invalid-feedback" role="alert">
						<strong>{{ $errors->first('resource_type_id') }}</strong>
					</span>
				@endif
				@if ($errors->has('file'))
					<span class="invalid-feedback" role="alert">
						<strong>{{ $errors->first('file') }}</strong>
					</span>
				@endif
			</div>
			<div class="form-group">
				<label for="name">Название *</label>
				<input class="form-input" type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
			</div>
			<div class="form-group">
				<label for="alias">Псевдоним *</label>
				<input class="form-input" type="text" id="alias" name="alias" value="{{ old('alias') }}" required autofocus>
			</div>
			<div class="form-group">
				<label for="description">Описание</label>
				<textarea id="description" name="description">{{ old('description') }}</textarea>
			</div>
			<div class="form-group">
				<label class="form-label" for="type">Тип</label>
				<select class="form-select" id="type" name="resource_type_id">				
				@foreach ($types as $type)
					<option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
				@endforeach
				</select>
			</div>
			<div class="form-group">
				<label class="form-label" for="file">Загрузить</label>
				<input class="form-input" type="file" id="file" name="file">
			</div>
			<button type="submit" class="btn btn-lg btn-primary">Создать материал</button>
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

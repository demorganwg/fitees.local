@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/ckeditor5-classic/ckeditor.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section section_edit">
	<h2>Редактировать группу</h2>
	<div class="form_container">
		<form method="POST" action="{{ route('admin.groups.update', ['id' => $groupId] ) }}"  enctype="multipart/form-data">
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
				<label class="form-label" for="name">Название группы *</label>
				<input class="form-input" type="text" id="name" name="name" value="{{ $data['name'] }}" required autofocus>
			</div>
			<button type="submit" class="btn btn-primary btn-lg">Сохранить изменения</button>
		</form>
		<form method="POST" action="{{ route('admin.groups.destroy', ['id' => $groupId ]) }}"  enctype="multipart/form-data">
			@method('DELETE')
			@csrf
			<button type="submit" class="btn btn-lg">Удалить группу</button>
		</form>
	</div>
</section>

<script>
	ClassicEditor.create(document.querySelector( '#description' )).catch( 
   	error => {console.error( error );
   });
</script>
@endsection

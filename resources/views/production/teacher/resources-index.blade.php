@extends (env('THEME').'.layouts.teacher')

@section('assets')
	<script src="{{ asset('assets/js/jquery-dragarrange/drag-arrange.min.js') }}"></script>
@endsection

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section">
	<h2>Материалы курса {{ $course['name'] }} </h2>
	<button id="btn-order" class="btn btn-lg">Изменить порядок</button>
	<form method="POST" action="{{ action('Teacher\ResourceController@changeResourcePosition', ['course_alias' => $course['alias']]) }}">
		@csrf
		<table class="table table-striped table-hover drag-list" style="margin: 20px 0">
			<tr>
				<th style="width: 300px">Имя</th>
				<td>Редактировать</td>
				<th>Псевдоним</th>
				<th>Описание</th>
				<th>Тип</th>
				<th>Отредактирован</th>
				<th>Создан</th>
			</tr>
			@foreach ($courseResources as $n => $resource)
			<tr class="draggable">
				<td style="width: 300px">
					<a href="{{ route('teacher.resources.show', ['course_alias' => $course['alias'], 'resource' => $resource['alias']])}}">{{ $resource['name'] }}</a>
					<span class="drag-area"><i class="icon icon-apps"></i></span>
					<input type="hidden" name="old-number-{{ $resource['number'] }}" value="{{ $resource['id'] }}">
				</td>
				<td><a class="edit" href="{{ route('teacher.resources.edit', ['course_alias' => $course['alias'], 'resource' => $resource['alias']])}}"><i class="icon icon-edit"></i></a></td>
				<td>{{ $resource['alias'] }}</td>
				<td>{{ $resource['description'] }}</td>
				<td>{{ $resource['type'] }}</td>
				<td>{{ $resource['updated_at'] }}</td>
				<td>{{ $resource['created_at'] }}</td>
			</tr>
			@endforeach
		</table>
		<button type="submit" id="btn-save" class="btn btn-lg btn-primary">Сохранить изменения</button>
	</form>
	<a class="btn btn-lg" href="{{ route('teacher.resources.create', ['course_alias' => $course['alias']])}}" style="margin-top: 20px">Добавить материал</a>
</section>
<script>
	$('.drag-list tr.draggable').arrangeable({dragSelector: '.drag-area'});
	$('#btn-order').on("click", function() {
		$(this).toggleClass("active");
		$('.drag-area').toggleClass("visible");
		$('#btn-save').toggleClass("visible");
	});
</script>
@endsection

@extends (env('THEME').'.layouts.teacher')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<section class="content_section section_edit">
	<h2>{{ $student['name'].' '.$student['surname'] }}</h2>
	<table class="table table-striped table-hover">
		<tr>
			<th>№</th>
			<th>Задание</th>
			<th>Дата выполнения</th>
			<th>Время выполнения</th>
			<th>Оценка</th>	
		</tr>
		@foreach ($courseAssignments as $n => $assignment)
		<tr>
			<td>{{ $assignment['number'] }}</td>
			<td>{{ $assignment['name'] }}</td>
			<td>{{ $assignment['date'] }}</td>
			<td>{{ $assignment['time'] }}</td>
			<td>{{ $assignment['score'] }}</td>
		</tr>
		@endforeach
	</table>
</section>
@endsection

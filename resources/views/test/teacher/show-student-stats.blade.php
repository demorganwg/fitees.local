@extends (env('THEME').'.layouts.teacher')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<div class="container">
		<div class="course_page">
			<h2>{{ $student['name'].' '.$student['surname'] }}</h2>
			<table>
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
		</div>
	</div>	
</div>
<style>
	h3 {
		margin-top: 40px;
	}
	
	table {
		width: 100%;
	}
	table td,th {
		border: 1px solid silver;
		padding: 3px 10px;
	}
</style>
@endsection

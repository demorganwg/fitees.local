@extends (env('THEME').'.layouts.site')

@section('header')
	{!! $header !!}
@endsection

@section('content')
<div class="content col-12">
	<div class="container">
		<div class="course_page">
			<h2>Оценки</h2>
			<table>
				<tr>
					<th>№</th>
					<th>Задание</th>
					<th>Оценка</th>
				</tr>
				@foreach ($result_list as $result)
					<tr>
						<td>{{ $result['number'] }}</td>
						<td>{{ $result['name'] }}</td>
						<td>{{ $result['score'] }}</td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>	
</div>
<style>
	.course_page table {
		width: 500px;
		margin: 0 auto;
	}
	.course_page table td,
	.course_page table th {
		padding: 5px 10px;
		border: 1px solid silver;
	}
</style>
@endsection

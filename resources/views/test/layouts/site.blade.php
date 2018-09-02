<!DOCTYPE html>
<html lang="ru">

<head>

	<meta charset="utf-8">
	<!-- <base href="/"> -->

	<title>{{ $title }}</title>
	<meta name="description" content="">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link rel="stylesheet" href="{{ asset(env('THEME')) }}/css/main.min.css">
	
@yield('assets')

</head>

<body>
	
	<!-- Custom HTML -->
	@yield('header')
	
	<div class="main_wrapper">
		<div class="row">
			@yield('content')
		</div>
	</div>

	<style>
		.main_wrapper {
			min-height: 1000px;
		} 
	</style>
	<script src="{{ asset(env('THEME')) }}/js/scripts.min.js"></script>

</body>
</html>

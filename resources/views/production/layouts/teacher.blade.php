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
	
	<script src="{{ asset(env('THEME')) }}/js/scripts.min.js"></script>
	
@yield('assets')

</head>

<body>
	
	@yield('header')
	
	<div class="content">
		@yield('content')
	</div>
	

</body>
</html>

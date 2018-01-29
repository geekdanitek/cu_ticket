<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield("title") : CU Ticket System</title>
	<link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('css/style.css') }}">
	<link rel="icon" href="{{ url('images/logo.png') }}" sizes="16x16 32x32" type="image/png"> 
	@yield('css')
</head>
@yield('nav')
<body>

@yield('content')

</body>
<footer>
	<script type="text/javascript" src="{{ url('js/jquery-3.2.1.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/bootstrap.min.js') }}"></script>
	@yield('js')
</footer>
</html>
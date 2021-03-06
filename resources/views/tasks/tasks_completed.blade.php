<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<title>{{$title}} task</title>
	<style type="text/css">
		body {
			padding: 0px;
			margin: 0px;
			background-color: pink;
		}
		h1 {
			color: #ffffff;
		}
		ul, li {
			font-family: "Hevica";
			font-weight: bold;
			color: #ffffff;
		}
		.task-heading {
			padding-left: 200px;
			padding-top: 0.5px;
			padding-bottom: 0.5px;
			background-color: #000000;
			margin-right: 400px;
			margin-left: 400px;
		}
		.task-completed {
			padding-left: 400px;
			background-color: blue;
		}
	</style>
</head>

<body>
	<div class="task-heading">
		<h1>{{$page_name}}</h1>
	</div>
	<div class="task-completed">
		<ul>
			@foreach($tasks as $task)

					<li>{{ $task->body }}</li>

			@endforeach
		</ul>
	</div>
</body>
</html>
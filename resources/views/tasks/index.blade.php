<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<title>hello</title>
</head>
<body>
	<ul>
		@foreach($tasks as $task)
		<li>
			<a href="{{route("tasks", ['id'=>$task->id])}}">{{$task->body}}</a>
		</li>
		@endforeach
	</ul>
</body>
</html>
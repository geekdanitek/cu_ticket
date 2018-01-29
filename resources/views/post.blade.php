<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<title>tasks</title>
</head>
<body>


{{-- <a href="{{route('tasks') }}/{{$id}}">hjvjhhj</a> --}}
	{{$task->body}}
	<ul>
	{{-- @foreach($tasks as $task)

		<li>{{ $task->body }}</li>
	
	@endforeach --}}
	</ul>
</body>
</html>
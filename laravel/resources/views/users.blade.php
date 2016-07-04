<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
		<body>

			@foreach( $users as $user )
				<br>
				{{$user->username}}
			@endforeach
			
		</body>
</html>
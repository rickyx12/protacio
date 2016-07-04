<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
		<body>

			@foreach($patients as $px)
					<br>	
						{{$px->registrationNo}}

			@endforeach

		</body>
</html>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="../../../../../bootstrap-3.3.6/css/bootstrap.css"></link>
	</head>
	<body>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>QTY</th>
					<th>Unitcost</th>
					<th>Location</th>
					<th>Encoded</th>
				</tr>
			</thead>
			<tbody>
				@foreach( $encodedEnding as $ending )
					<tr>
						<td>
							{{ $ending->endingQTY }}
						</td>
						<td>
							{{ $ending->unitcost }}
						</td>
						<td>
							{{ $ending->inventoryLocation }}
						</td>
						<td>
							{{ $ending->username }}
						</td>

					</tr>
				@endforeach
			</tbody>
		</table>
	</body>
</html>
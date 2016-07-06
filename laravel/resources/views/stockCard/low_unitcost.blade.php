<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="../../../../../bootstrap-3.3.6/css/bootstrap.css"></link>
	</head>
	<body>
		@inject('ro','App\Helpers\Contracts\DatabaseContract')
		<div class="container">
			<div class="col-sm-5">
				<table class="table table-hover">
					<thead>
						<th>Stock#</th>
						<th>Generic</th>
						<th>Brand</th>
						<th>Unitcost</th>
					</thead>
					<tbody>
						@foreach($stockCardNo as $stock)
							@if( $ro->select('inventory','unitcost','stockCardNo',$stock->stockCardNo) < 2 )
								<tr>
									<td>{{ $stock->stockCardNo }}</td>
									<td>{{ $ro->select('inventory','genericName','stockCardNo',$stock->stockCardNo) }}</td>
									<td>{{ $ro->select('inventory','description','stockCardNo',$stock->stockCardNo) }}</td>
									<td>{{ $ro->select('inventory','unitcost','stockCardNo',$stock->stockCardNo) }}</td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>	
	</body>
</html>
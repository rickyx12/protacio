<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="../../../../../bootstrap-3.3.6/css/bootstrap.css"></link>
	</head>
	<body>
		@inject('ro','App\Helpers\databaseNow')
		<div class="container">
			<div class="col-sm-4">
				<table class="table table-bootstrap">
					<thead>
						<tr>
							<th>Stock#</th>
							<th>Generic</th>
							<th>Unitcost</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $stockCardNo as $stock )
							@if( $ro->selectNow('inventory','unitcost','stockCardNo',$stock->stockCardNo) < 2 )
								<tr>
									<td>
										{{ $stock->stockCardNo }}
									</td>
									<td>
										{{ $ro->selectNow('inventoryStockCard','genericName','stockCardNo',$stock->stockCardNo) }}
									</td>
									<td>
										{{ $ro->selectNow('inventory','unitcost','stockCardNo',$stock->stockCardNo) }}
									</td>
								</tr>	
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>
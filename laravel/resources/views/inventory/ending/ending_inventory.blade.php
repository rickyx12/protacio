<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<title></title>
		<script src='../../../../../COCONUT/js/jquery-2.1.4.min.js'></script>
		<script src='../../../../../COCONUT/js/jquery-ui.min.js'></script>
		<script src='../../../../../COCONUT/js/jquery.tooltipster.min.js'></script>
		<link rel="stylesheet" href="../../../../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script src='../../../../../bootstrap-3.3.6/js/bootstrap.js'></script>
		<link rel="stylesheet" href="../../../../../COCONUT/js/jquery-ui.css"></link>
		<link rel="stylesheet" href="../../../../../COCONUT/myCSS/tooltipster.css"></link>
		<link rel="stylesheet" href="../../../../../COCONUT/myCSS/tooltipster-noir.css"></link>

		<script>
			$(document).ready(function(){

				@foreach( $ending as $end )
					$(".details{{ $end->stockCardNo }}").tooltipster({
						content: $('<span>Loading....</span>'),
						position: 'right',
						theme: 'tooltipster-noir',
						contentAsHTML:true,
						functionBefore:function(origin,continueTooltip) {
							continueTooltip();
							if( origin.data('ajax') !== 'cached' ){ 
								$.ajax({
									type:'POST',
									url:'{{ url('inventory/ending',['stockCardNo' => $end->stockCardNo,'quarter' => $end->quarter]) }}',
									success:function(data) {
										origin.tooltipster('content',data).data('ajax','cached');
									},
									 headers: {
								     	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
									}
								});
							}
						}										
					});

					$("#addInventory{{ $end->stockCardNo }}").click(function(){

						var endQTY = $('#endQTY{{ $end->stockCardNo }}').val();

						$.ajax({
							type:"POST",
							url:"{{ url('inventory/ending/put/medicine',[
							'stockCardNo' => $end->stockCardNo,
							'endQTY' => $end->endQTY,
							]) }}",
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							}
						});

					});

				@endforeach

			});
		</script>


	</head>
	<body>
		<? $totalItems = 0 ?>
		<? $totalCost = 0 ?>
		@inject('ro','App\Helpers\Contracts\DatabaseContract')
		<div class="container">
			<h3>Ending Inventory Consolidation</h3>
			<div class="col-sm-5">
				<table class="col-sm-5 table table-hover">
					<thead>
						<th>Stock#</th>
						<th>Particulars</th>
						<th>End QTY</th>
						<th>Cost</th>
						<th></th>
					</thead>
					<tbody>
						@foreach( $ending as $end )
							<? $totalItems += 1 ?>
							<tr>
								<td>
									{{ $end->stockCardNo }}
								</td>
								<td>
									<span class="details{{ $end->stockCardNo }}">
										@if( $end->inventoryType == "medicine" )
											{{ $end->genericName }}
											<br>
											<font size=2 color="red">
												[{{ $end->description }}]
											</font>
										@else
											{{ $end->description }}
										@endif
									</span>
								</td>
								<td>
									<span class='details{{ $end->stockCardNo }}'>
										{{ $end->endQTY }}
									</span>
								</td>
								<td>
									<span class='details{{ $end->stockCardNo }}'>
										{{ number_format($end->totalCost,2) }}
										<? $totalCost += ($end->totalCost) ?>
									</span>
								</td>
								<td>
									@if( $ro->doubleSelectCondition('inventory','inventoryCode','stockCardNo',$end->stockCardNo,'=','status','DELETED%','not like') )

									@elseif( $ro->doubleSelectCondition('inventory','inventoryCode','stockCardNo',$end->stockCardNo,'=','quantity','0','!=') )

									@else
										<input type="button" id="addInventory{{ $end->stockCardNo }}" class="btn btn-success" value="Add Inventory">										
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td></td>						
							<td><b>Total Items {{ $totalItems }}</b></td>
							<td></td>
							<td><? echo number_format($totalCost,2) ?></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</body>
</html>
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
				@endforeach

			});
		</script>


	</head>
	<body>
		<? $totalItems = 0 ?>
		<div class="container">
			<h3>Ending Inventory Consolidation</h3>
			<div class="col-sm-5">
				<table class="col-sm-5 table table-hover">
					<thead>
						<th>Stock#</th>
						<th>Particulars</th>
						<th>End QTY</th>
						<th>Cost</th>
					</thead>
					<tbody>
						@foreach( $ending as $end )
							<? $totalItems += 1 ?>
							<tr>
								<td>
									{{ $end->stockCardNo }}
								</td>
								<td>
									@if( $end->inventoryType == "medicine" )
										{{ $end->genericName }}
									@else
										{{ $end->description }}
									@endif
								</td>
								<td>
									<span class='details{{ $end->stockCardNo }}'>
										{{ $end->endQTY }}
									</span>
								</td>
								<td>
									<span class='details{{ $end->stockCardNo }}'>
										{{ number_format($end->totalCost * $end->endQTY,2) }}
									</span>
								</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td></td>						
							<td><b>Total Items {{ $totalItems }}</b></td>
							<td></td>
							<td></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</body>
</html>
<?

	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$inventoryType = $_POST['inventoryType'];
	$quarter = $_POST['quarter'];

	$totalItems = 0;
	$grandTotalCost = 0;


	$ro = new database();
	$ro4 = new database4();

	$ro4->ending_inventory_list($quarter,$inventoryType)

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<script src="../js/jquery.tooltipster.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<link rel="stylesheet" href="../myCSS/tooltipster.css"></link>
		<link rel="stylesheet" href="../myCSS/tooltipster-noir.css"></link>

		<script>
			$(document).ready(function(){
				<? foreach( $ro4->ending_inventory_list_stockCardNo() as $stockCardNo ) { ?>
					$(".details<? echo $stockCardNo ?>").tooltipster({
						content: $('<span>Loading....</span>'),
						position: 'right',
						theme: 'tooltipster-noir',
						contentAsHTML:true,
						interactive:true,
						functionBefore:function(origin,continueTooltip) {
							continueTooltip();
							if( origin.data('ajax') !== 'cached' ){ 
								$.ajax({
									type:'POST',
									url:'ending-inventory-details.php',
									data:{stockCardNo:'<? echo $stockCardNo ?>',quarter:'<? echo $quarter ?>'},
									success:function(data) {
										origin.tooltipster('content',data).data('ajax','');
									}
								});
							}
						}															
					});				
				<? } ?>
			});
		</script>

	</head>
	<body>
		<div class="container">
			<h3>Ending Inventory Consolidation</h3>
			<div class="col-md-7">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Stock#</th>
							<th>Particulars</th>
							<th>End QTY</th>
							<th>Pharmacy</th>
							<th>N.Station</th>
							<th>E.R</th>
							<th>O.R</th>
							<th>Cost</th>
						</tr>
					</thead>
					<tbody>
						<? for( $a=0,$b=0;$a<count( $ro4->ending_inventory_list_stockCardNo() ),$b<count( $ro4->ending_inventory_list_totalCost() );$a++,$b++ ) { ?>
							<? $stockCardNo = $ro4->ending_inventory_list_stockCardNo()[$a]; ?>
								<tr>
									<td>
										<?
											echo $ro4->ending_inventory_list_stockCardNo()[$a];
											$totalItems += 1;
										?>
									</td>
									<td>
										<span class="details<? echo $stockCardNo ?>">
											<? if( $ro->selectNow("inventoryStockCard","inventoryType","stockCardNo",$stockCardNo) == "medicine" ) { ?>
											<?
												echo $ro->selectNow("inventoryStockCard","genericName","stockCardNo",$stockCardNo)
											?>
											<h6>
												<?
													echo $ro->selectNow("inventoryStockCard","description","stockCardNo",$stockCardNo)
												?>
											</h6>
											<? }else { ?>
												<?
													echo $ro->selectNow("inventoryStockCard","description","stockCardNo",$stockCardNo)
												?>
											<? } ?>
										</span>
									</td>
									<td>
										<?
											echo $ro4->ending_inventory_sumQTY($stockCardNo,$quarter,"")
										?>
									</td>
									<td>
										<?
											echo $ro4->ending_inventory_sumQTY($stockCardNo,$quarter,"PHARMACY")
										?>
									</td>
									<td>
										<?
											echo $ro4->ending_inventory_sumQTY($stockCardNo,$quarter,"NURSING")
										?>
									</td>
									<td>
										<?
											echo $ro4->ending_inventory_sumQTY($stockCardNo,$quarter,"E.R")
										?>
									</td>
									<td>
										<?
											echo $ro4->ending_inventory_sumQTY($stockCardNo,$quarter,"OR")
										?>
									</td>									
									<td>
										<?
											( $ro4->ending_inventory_list_totalCost()[$b] > 0 ) ? $x = number_format($ro4->ending_inventory_list_totalCost()[$b],2) : $x = "";
											echo $x;
											$grandTotalCost += $ro4->ending_inventory_list_totalCost()[$b];
										?>
									</td>									
								</tr>
						<? } ?>
					</tbody>
					<tfoot>
						<tr>
							<td></td>
							<td><? echo $totalItems ?></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td><? echo number_format($grandTotalCost,2) ?></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</body>
</html>
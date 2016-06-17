<? include "../../myDatabase.php"; ?>
<? include "../../myDatabase4.php" ?>
<? $ro = new database() ?>
<? $ro4 = new database4() ?>
<? $grandTotal = 0 ?>
<? $ro4->ending_inventory_list() ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../../jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script src="../../bootstrap-3.3.6/js/bootstrap.js"></script>	

		<script>
			$(document).ready(function(){
				$("#medicineBtn").click(function(){
					window.location = "ending-inventory-medicine.php";
				});
			});
		</script>

	</head>
	<body>
		<div class="container">
			<h3>Ending Inventory Supplies</h3>
			<div class="btn-group">
				<button id="medicineBtn" type="button" class="btn btn-default">Medicine</button>
				<button type="button" class="btn btn-info">Supplies</button>
			</div>
			<div class="col-md-12">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Description</th>
							<th>Ending QTY</th>
							<th>Amount</th>
							<th>Quarter</th>
						</tr>
					</thead>
					<tbody>
						<? foreach($ro4->ending_inventory_list_endingNo() as $endingNo) { ?>
							<tr>
								<? if( $ro->selectNow("inventory","inventoryType","inventoryCode",$ro->selectNow("endingInventory","inventoryCode","endingNo",$endingNo)) == "supplies" ) { ?>

									<td><? echo $ro->selectNow("inventory","description","inventoryCode",$ro->selectNow("endingInventory","inventoryCode","endingNo",$endingNo)) ?></td>	
									<td><? echo $ro->selectNow("endingInventory","endingQTY","endingNo",$endingNo) ?></td>		
									<td>
										<?
											$inventoryCode = $ro->selectNow("endingInventory","inventoryCode","endingNo",$endingNo);
											$endingQTY = $ro->selectNow("endingInventory","endingQTY","endingNo",$endingNo);
											$unitcost = $ro->selectNow("inventory","suppliesUNITCOST","inventoryCode",$inventoryCode);
											echo number_format($endingQTY * $unitcost,2);
											$grandTotal += ($endingQTY * $unitcost);
										
										?>
									</td>				
									<td><? echo $ro->selectNow("endingInventory","quarter","endingNo",$endingNo) ?></td>

								<? } ?>

								<??>
							</tr>
						<? } ?>
					</tbody>
					<tfoot>
						<tr>
							<td></td>
							<td></td>
							<td><? echo number_format($grandTotal,2) ?></td>
							<td></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</body>
</html>
<? include "../../myDatabase.php" ?>
<? include "../../myDatabase4.php" ?>
<? $ro = new database() ?>
<? $ro4 = new database4() ?>
<? $ro4->inventory_list("medicine") ?>
<!doctype html>
<html>
	<head>
		<title>Movement</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../../jquery-2.1.4.min.js"></script>
	<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
	<script src="../../bootstrap-3.3.6/js/bootstrap.js"></script>

	<script>
		$(document).ready(function() {
			$("#suppliesBtn").click(function(){
				window.location = "movement-supplies.php";
			});
		});
	</script>

	</head>
	<body>
		<div class="container">
			<div class="row">
				<h3>Movement</h3>
				<div class="btn-group">
					<button id="medicineBtn" type="button" class="btn btn-info">Medicine</button>
					<button id="suppliesBtn" type="button" class="btn btn-default">Supplies</button>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Generic Name</th>
								<th>Brand Name</th>
								<th>Beginning</th>
								<th>Dispensed</th>
								<th>Remaining</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<? foreach($ro4->inventory_list_inventoryCode() as $inventoryCode) { ?>
								<tr>
									<td><? echo $ro->selectNow("inventory","genericName","inventoryCode",$inventoryCode) ?></td>
									<td><? echo $ro->selectNow("inventory","description","inventoryCode",$inventoryCode) ?></td>
									<td><? echo $ro->selectNow("inventory","beginningQTY","inventoryCode",$inventoryCode) ?></td>
									<td><? echo $ro4->dispensed_quantity($inventoryCode); 

										$cost = ( $ro4->dispensed_quantity($inventoryCode) * $ro->selectNow("inventory","unitcost","inventoryCode",$inventoryCode) );

										( $cost > 0 ) ? $x = " - ".number_format($cost,2) : $x = ""; 

										echo $x;

									   ?></td>
									<td><? echo $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode);

										$cost = ( $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode) * $ro->selectNow("inventory","unitcost","inventoryCode",$inventoryCode) );

										( $cost > 0 ) ? $x = " - ".number_format($cost,2) : $x = "";

										echo $x;


									 ?></td>

									<? if( ($ro4->dispensed_quantity($inventoryCode) + $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode)) == $ro->selectNow("inventory","beginningQTY","inventoryCode",$inventoryCode) ) { ?>
										<td><i class="glyphicon glyphicon-ok"></i></td>
									<? }else { ?>

										<? if( $ro->selectNow("editedInventory","editNo","inventoryCode",$inventoryCode) ) { ?>
											<td><i class="glyphicon glyphicon-wrench"></i></td>
										<? }else { ?>
											<td><i class="glyphicon glyphicon-remove"></i></td>
										<? } ?>
									<? } ?>
								</tr>
							<? } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>
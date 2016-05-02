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
	</head>
	<body>
		<div class="container">
			<div class="row">
				<h3>Movement</h3>
			</div>
			<div class="row">
				<div class="col-md-10">
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
									<td><? echo $ro4->dispensed_quantity($inventoryCode) ?></td>
									<td><? echo $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode) ?></td>

									<? if( ($ro4->dispensed_quantity($inventoryCode) + $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode)) == $ro->selectNow("inventory","beginningQTY","inventoryCode",$inventoryCode) ) { ?>
										<td><i class="glyphicon glyphicon-ok"></i></td>
									<? }else { ?>
										<td><i class="glyphicon glyphicon-remove"></i></td>
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
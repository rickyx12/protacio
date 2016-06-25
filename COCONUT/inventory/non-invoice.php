<? include "../../myDatabase.php" ?>
<? include "../../myDatabase4.php" ?>
<? $ro = new database() ?>
<? $ro4 = new database4() ?>
<? $totalItems = 0 ?>
<? $ro4->non_invoice_inventory("medicine") ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Non-Invoice Inventory</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../../jquery1.11.1.js"></script>
		<script src="../js/jquery.tooltipster.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="../myCSS/tooltipster.css">
		<link ref="stylesheet" href="../myCSS/tooltipster-noir.css">
		<script src="../../bootstrap-3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<h3>Non Invoice Inventory</h3>
			<form method="post" action="non-invoice-delete.php">
				<div class="row">
					<table class="table table-hover">
						<thead>
							<tr>
								<th></th>
								<th>Code#</th>
								<th>Stock#</th>
								<th>Brand</th>
								<th>Generic</th>
								<th>Details</th>
								<th>QTY</th>
								<th>End QTY</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<? foreach( $ro4->non_invoice_inventory_inventoryCode() as $inventoryCode ) { ?>
								<? $totalItems += 1 ?>
								<tr>
									<td>
										<? if( $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode) == 0 ) { ?>
											<input type="checkbox" name="inventoryCode[]" value="<? echo $inventoryCode ?>" checked>
										<? }else { ?>
											<input type="checkbox" name="inventoryCode[]" value="<? echo $inventoryCode ?>">
										<? } ?>

									</td>
									<td>
										<?
											echo $inventoryCode
										 ?>
									</td>

									<td>
										<?
											echo $ro->selectNow("inventory","stockCardNo","inventoryCode",$inventoryCode)
										?>
									</td>

									<td>
										<?
											echo $ro->selectNow("inventory","description","inventoryCode",$inventoryCode)
										?>
									</td>

									<td>
										<?
											echo $ro->selectNow("inventory","genericName","inventoryCode",$inventoryCode)
										?>
									</td>

									<td>
										<?
											echo $ro4->formatDate($ro->selectNow("inventory","dateAdded","inventoryCode",$inventoryCode))." - ".$ro->selectNow("inventory","addedBy","inventoryCode",$inventoryCode)
										?>
									</td>

									<td>
										<?
											echo $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode)
										?>
									</td>

									<td>
										
											<input type="text" class="form-control" placeholder="QTY">
										
									</td>

									<td>
										
											<input type="button" class="btn btn-default" value="Save">
										
									</td>

								</tr>
							<? } ?>
						</tbody>
						<tfoot>
							<tr>
								<td></td>
								<td></td>
								<td><? echo $totalItems." Items" ?></td>
								<td></td>
								<td></td>
							</tr>
						</tfoot>
					</table>
				</div>

				<div class="row">
					<div class="col-md-12 text-center">
						<input type="submit" class="btn btn-danger" value="Delete">
					</div>
				</div>

				<div class="row">
					<h1>&nbsp;</h1>
				</div>

			</form>

		</div>
	</body>
</html>
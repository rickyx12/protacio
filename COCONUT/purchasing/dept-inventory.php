<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$inventoryLocation = $_POST['inventoryLocation'];

	$ro = new database();
	$ro4 = new database4();

	$ro4->ekit_inventory($inventoryLocation);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
	</head>
	<body>
		<div class="container">
			<h3><? echo $inventoryLocation ?></h3>
			<div class="col-md-7">
				<? if( $ro4->ekit_inventory_inventoryCode() != "" ) { ?>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Particulars</th>
							<th>QTY</th>
							<th>Added</th>
							<th>Added By</th>
						</tr>
					</thead>
					<tbody>
						<? foreach( $ro4->ekit_inventory_inventoryCode() as $inventoryCode ) { ?>
							<tr>
								<td>
									<? if( $ro->selectNow("inventory","inventoryType","inventoryCode",$inventoryCode) == "medicine" ) { ?>
									<?
										echo $ro->selectNow("inventory","genericName","inventoryCode",$inventoryCode)
									?>
									<h6>
										<?
											echo $ro->selectNow("inventory","description","inventoryCode",$inventoryCode)
										?>
									</h6>
									<? }else {  ?>
										<?
											echo $ro->selectNow("inventory","description","inventoryCode",$inventoryCode)
										?>
									<? } ?>
								</td>
								<td>
									<?
										echo $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode)
									?>
								</td>
								<td>
									<?
										echo $ro4->formatDate($ro->selectNow("inventory","dateAdded","inventoryCode",$inventoryCode))
									?>
								</td>
								<td>
									<?
										echo $ro->selectNow("inventory","addedBy","inventoryCode",$inventoryCode)
									?>
								</td>
							</tr>
						<? } ?>
					</tbody>
				</table>
				<? }else { ?>
					<h1>
						No Inventory Available	
					</h1>
				<? } ?>
			</div>
		</div>
	</body>
</html>
<? 
	include "../../myDatabase.php";
	include "../../myDatabase4.php";
	$inventoryType = $_GET['inventoryType'];

	$ro = new database();
	$ro4 = new database4();

	$ro4->stock_room($inventoryType);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Stock Room</title>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
	</head>
	<body>
		<div class="container">
			<h3>
				<? echo ucfirst($inventoryType) ?>
			</h3>
			<div class="col-md-12">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Invoice#</th>
							<th>StockCard#</th>
							<? if( $inventoryType == "medicine" ) { ?>
								<th>Generic</th>
								<th>Brand</th>
							<? }else { ?>
								<th>Particulars</th>
							<? } ?>
							<th>QTY</th>
							<th>Unitcost</th>
							<th>Added</th>
							<th>Expiration</th>
							<th>Encoded</th>
						</tr>
					</thead>
					<tbody>
						<? foreach( $ro4->stock_room_inventoryCode() as $inventoryCode ) { ?>
							<tr>
								<td>
									<? echo $ro->selectNow("inventory","invoiceNo","inventoryCode",$inventoryCode) ?>
								</td>
								<td>
									<? echo $ro->selectNow("inventory","stockCardNo","inventoryCode",$inventoryCode) ?>
								</td>

								<? if( $inventoryType == "medicine" ) { ?>
									<td>
										<? echo $ro->selectNow("inventory","genericName","inventoryCode",$inventoryCode) ?>
									</td>
									<td>
										<? echo $ro->selectNow("inventory","description","inventoryCode",$inventoryCode) ?>
									</td>
								<? }else { ?>
									<td>
										<? echo $ro->selectNow("inventory","description","inventoryCode",$inventoryCode) ?>
									</td>
								<? } ?>

								<td>
									<? echo $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode) ?>
								</td>
								<td>
									<? echo $ro->selectNow("inventory","unitcost","inventoryCode",$inventoryCode) ?>
								</td>
								<td>
									<? echo $ro4->formatDate($ro->selectNow("inventory","dateAdded","inventoryCode",$inventoryCode)) ?>
								</td>
								<td>
									<? echo $ro4->formatDate($ro->selectNow("inventory","expiration","inventoryCode",$inventoryCode)) ?>
								</td>
								<td>
									<? echo $ro->selectNow("inventory","addedBy","inventoryCode",$inventoryCode) ?>
								</td>
							</tr>
						<? } ?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>
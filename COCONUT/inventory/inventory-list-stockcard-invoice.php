<?
include "../../myDatabase.php";
include "../../myDatabase4.php";

$stockCardNo = $_POST['stockCardNo'];
$fromDate = $_POST['fromDate'];
$toDate = $_POST['toDate'];

$ro = new database();
$ro4 = new database4();

$ro4->get_purchases_via_stockcard($stockCardNo,$fromDate,$toDate);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
	</head>
	<body>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Invoice</th>
					<th>Amount</th>
					<th>Date</th>
					<th>User</th>
				</tr>
			</thead>
			<tbody>
				<? foreach( $ro4->get_purchases_via_stockcard_inventoryCode() as $inventoryCode ) { ?>
					<tr>
						<td>
							<?
								echo $ro->selectNow("inventory","invoiceNo","inventoryCode",$inventoryCode)
							?>
						</td>
						<td>
							<?
								echo number_format($ro->selectNow("inventory","beginningCapital","inventoryCode",$inventoryCode),2)
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
	</body>
</html>
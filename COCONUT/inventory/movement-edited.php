<?
include "../../myDatabase.php";
include "../../myDatabase4.php";

$inventoryCode = $_POST['inventoryCode'];

$ro = new database();
$ro4 = new database4();
$ro4->edited_inventory($inventoryCode);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  	<title></title>
	<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>  
</head>
<body>
	<h5>Edit History</h5>
	<table class="table">
		<thead>
			<tr>
				<th>Date</th>
				<th>Orig. QTY</th>
				<th>User</th>
			</tr>
		</thead>
		<? foreach($ro4->edited_inventory_editNo() as $editNo) { ?>
			<tr>
				<td><? echo $ro4->formatDate($ro->selectNow("editedInventory","date","editNo",$editNo)) ?></td>
				<td class="text-center"><? echo $ro->selectNow("editedInventory","quantity","editNo",$editNo) ?></td>
				<td><? echo $ro->selectNow("editedInventory","username","editNo",$editNo) ?></td>
			</tr>
		<? } ?>
	</table>
</body>
</html>

<?
	
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$stockCardNo = $_POST['stockCardNo'];
	$quarter = $_POST['quarter'];

	$totalCost = 0;

	$ro = new database();
	$ro4 = new database4();

	$ro4->ending_inventory_list_details($stockCardNo,$quarter);

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
					<th>QTY</th>
					<th>Unitcost</th>
					<th>Total</th>
					<th>Location</th>
					<th>Encoded</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<? foreach( $ro4->ending_inventory_list_details_endingNo() as $endingNo ) { ?>
					<tr>
						<td>
							<?
								echo $ro->selectNow("endingInventory","endingQTY","endingNo",$endingNo)
							?>
						</td>
						<td>
							<?
								echo $ro->selectNow("endingInventory","unitcost","endingNo",$endingNo)
							?>
						</td>
						<td>
							<?
								echo number_format( $ro->selectNow("endingInventory","endingQTY","endingNo",$endingNo) * $ro->selectNow("endingInventory","unitcost","endingNo",$endingNo),2);

								$totalCost += ($ro->selectNow("endingInventory","endingQTY","endingNo",$endingNo) * $ro->selectNow("endingInventory","unitcost","endingNo",$endingNo));

							?>
						</td>
						<td>
							<?
								echo $ro->selectNow("endingInventory","inventoryLocation","endingNo",$endingNo)
							?>
						</td>
						<td>
							<?
								echo $ro->selectNow("endingInventory","username","endingNo",$endingNo)
							?>
						</td>
						<? if( $ro4->doubleSelectCondition('inventory','inventoryCode','stockCardNo',$stockCardNo,'=','status','DELETED%','not like') ) { ?>

						<? }else { ?>
							<td>
								<!----
								<button id="add<? echo $endingNo ?>" class="btn btn-success btn-xs">
									Add
								</button>
								-->
							</td>
						<? } ?>
					</tr>
				<? } ?>
			</tbody>
			<tfoot>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td><? echo number_format($totalCost,2) ?></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tfoot>
		</table>
	</body>
</html>
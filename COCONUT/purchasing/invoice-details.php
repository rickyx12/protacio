<?
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$ro = new database();
	$ro4 = new database4();

	$siNo = $_POST['siNo'];
	$ro4->get_invoice_items($siNo);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
	</head>
	<body>
		<? if( $ro4->get_invoice_items_refNo() != "" ) { ?>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Description</th>
						<th>QTY</th>
						<th>Free</th>
						<th>Total QTY</th>
						<th>Unitcost</th>
						<th>Total Cost</th>
					</tr>
				</thead>
				<tbody>
					<? foreach( $ro4->get_invoice_items_refNo() as $refNo ) { ?>
						<tr>
							<td>
								<?
									echo $ro->selectNow("salesInvoiceItems","description","refNo",$refNo)
								?>
							</td>
							<td>
								<?
									echo ($ro->selectNow("salesInvoiceItems","quantity","refNo",$refNo) - $ro->selectNow("salesInvoiceItems","fgquantity","refNo",$refNo))
								?>
							</td>
							<td>
								<?
									echo $ro->selectNow("salesInvoiceItems","fgquantity","refNo",$refNo)

								?>
							</td>
							<td>
								<?
									echo $ro->selectNow("salesInvoiceItems","quantity","refNo",$refNo)
								?>
							</td>
							<td>
								<?
									echo $ro->selectNow("salesInvoiceItems","unitPrice","refNo",$refNo)
								?>
							</td>
							<td>
								<?
									$qty = ($ro->selectNow("salesInvoiceItems","quantity","refNo",$refNo) - $ro->selectNow("salesInvoiceItems","fgquantity","refNo",$refNo));
									$cost = $ro->selectNow("salesInvoiceItems","unitPrice","refNo",$refNo);
									$totalCost = ( $qty * $cost );
									
									( $totalCost > 0 ) ? $x = number_format($totalCost,2) : $x = "";
									echo $x;

								?>
							</td>
						</tr>
					<? } ?>
				</tbody>
			</table>
		<? }else { ?>
			<h3>No Results</h3>
		<? } ?>
	</body>
</html>
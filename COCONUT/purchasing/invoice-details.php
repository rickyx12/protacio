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
						<th>Unitcost</th>
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
									echo $ro->selectNow("salesInvoiceItems","unitPrice","refNo",$refNo)
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
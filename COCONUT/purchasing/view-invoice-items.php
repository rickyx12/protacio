<? require_once "../authentication.php" ?>
<? include "../../myDatabase.php" ?>
<? include "../../myDatabase4.php" ?>

<? $siNo = $_POST['siNo'] ?>

<? $ro = new database() ?>
<? $ro4 = new database4() ?>
<? $ro4->get_invoice_items($siNo) ?>
<? $total = 0 ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>

		<script>
			$(document).ready(function(){

				<? foreach( $ro4->get_invoice_items_refNo() as $refNo ) { ?>

					$("#removeBtn<? echo $refNo ?>").click(function(){

						$.post("delete-invoice-item.php",{refNo:<? echo $refNo ?>},function(result){
							console.log(result);
							$("#invoiceItems").load("view-invoice-items.php",{ siNo:<? echo $siNo ?> });
						});

					});

				<? } ?>


			});
		</script>

	</head>
	<body>
		<div class="container">
			<div class="col-md-6">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Particulars</th>
							<th>QTY</th>
							<th>Unitcost</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<? foreach( $ro4->get_invoice_items_refNo() as $refNo ) { ?>
							<tr>
								<? $unitcost = $ro->selectNow('salesInvoiceItems','unitPrice','refNo',$refNo) ?>
								<? $qty = $ro->selectNow('salesInvoiceItems','quantity','refNo',$refNo) ?>
								<? $total += ($unitcost * $qty) ?>
								<td>
									<?
										echo $ro->selectNow('salesInvoiceItems','description','refNo',$refNo)
									?>
								</td>
								<td>
									<?
										echo $qty
									?>
								</td>
								<td>
									<?
										echo $unitcost
									?>
								</td>
								<td>
									<input type="button" id="removeBtn<? echo $refNo ?>" class="btn btn-danger" value="Remove">
								</td>
							</tr>
						<? } ?>
					</tbody>
				</table>
				<div class="col-md-12 text-right">
					<h3>
						Total&nbsp;
						<? 
							echo number_format($total,2)
						 ?>
					</h3>
				</div>
			</div>
		</div>
	</body>
</html>
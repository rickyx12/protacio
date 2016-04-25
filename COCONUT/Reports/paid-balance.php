<? include "../../myDatabase.php"; ?>
<? include "../../myDatabase4.php" ?>
<? $ro = new database() ?>
<? $ro4 = new database4(); ?>

<?

if(isset($_POST['fromDate'])) {
	$fromDate = $_POST['fromDate'];
}else {
	$fromDate = date("Y-m-d");
}

if(isset($_POST['toDate'])) {
	$toDate = $_POST['toDate'];
}else {
	$toDate = date("Y-m-d");
}

?>

<? $ro4->paid_balance($fromDate,$toDate) ?>
<? $paid = 0 ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../../jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script src="../../bootstrap-3.3.6/js/bootstrap.js"></script>	
	</head>
	<body>
		<div class="container">
		<div class="row">
		<form method="post" action="<? $_SERVER['PHP_SELF'] ?>">
		<div class="col-md-2">
			<input type="text" name="fromDate" autocomplete="off" class="form-control" value="<? echo $fromDate ?>">
		</div>
		<div class="col-md-2">
			<input type="text" name="toDate" autocomplete="off" class="form-control" value="<? echo $toDate ?>">
		</div>
		<div class="col-md-2">
			<input type="submit" class="btn btn-info" value="Submit">
		</div>
		</form>
		</div>
		<div class="row">
		<h3>Paid Balance</h3>
			<div class="col-md-8">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Reg#</th>
							<th>Patient</th>
							<th>Description</th>
							<th>Paid</th>
							<th>Date</th>
							<th>Cashier</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<? foreach($ro4->paid_balance_itemNo() as $itemNo) { ?>

							<? if($ro->selectNow("patientCharges","paidVia","itemNo",$itemNo) == "Cash") { ?>
								<? $paid = $ro->selectNow("patientCharges","cashPaid","itemNo",$itemNo) ?>
							<? }else { ?>
								<? $paid = $ro->selectNow("patientCharges","amountPaidFromCreditCard","itemNo",$itemNo) ?>
							<? } ?>

							<tr>

								<td><? echo $ro->selectNow("patientCharges","registrationNo","itemNo",$itemNo) ?></td>

								<td><? echo $ro->selectNow("patientRecord","completeName","patientNo",$ro->selectNow("registrationDetails","patientNo","registrationNo",$ro->selectNow("patientCharges","registrationNo","itemNo",$itemNo))) ?></td>

								<td><? echo $ro->selectNow("patientCharges","description","itemNo",$itemNo) ?></td>

								<td><? echo $paid ?></td>

								<td><? echo $ro4->formatDate($ro->selectNow("patientCharges","datePaid","itemNo",$itemNo)) ?></td>

								<td><? echo $ro->selectNow("patientCharges","paidBy","itemNo",$itemNo) ?></td>

								<form method="post" action="paid-balance1.php" target="_blank">
									<input type="hidden" name="itemNo" value="<? echo $itemNo ?>">
									<input type="hidden" name="paid" value="<? echo $paid ?>">
									<td><input id="balanceBtn<? echo $itemNo ?>" type="submit" class="btn btn-success" value="Balance History"></td>
								</form>
							</tr>
						<? } ?>
					</tbody>
				</table>
			</div>
			</div>
		</div>
	</body>
</html>
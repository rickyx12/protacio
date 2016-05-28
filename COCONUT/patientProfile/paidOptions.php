<? include "../../myDatabase.php" ?>
<? include "../../myDatabase4.php" ?>

<? $ro = new database() ?>
<? $ro4 = new database4() ?>
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
		<? $registrationNo = $_GET['registrationNo']; ?>
		<? $itemNo = $_GET['itemNo']; ?>
		<div class="container">
			<div class="col-md-5">
				<h3><? echo $ro->selectNow("patientCharges","description","itemNo",$itemNo) ?></h3>
				<h5>Date Paid: <? echo $ro4->formatDate($ro->selectNow("patientCharges","datePaid","itemNo",$itemNo)) ?> @ <? echo $ro->selectNow("patientCharges","reportShift","itemNo",$itemNo) ?></h5>
				<h5>Total: <? echo $ro->selectNow("patientCharges","total","itemNo",$itemNo) ?></h5>
				<h5>Paid: <? echo $ro->selectNow("patientCharges","cashPaid","itemNo",$itemNo) ?></h5>
				<h5>Unpaid: <? echo $ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemNo) ?> <a href="paidOptions_newCharges.php?registrationNo=<? echo $registrationNo ?>&itemNo=<? echo $itemNo ?>" style="color:red">[New Charges]</a> </h5>
				<h5></h5>
			</div>
		</div>
	</body>
</html>
<?php
include "../../myDatabase.php";
$status = $_GET['status'];
$registrationNo = $_GET['registrationNo'];
$chargesCode = $_GET['chargesCode'];
$description = $_GET['description'];
$sellingPrice = $_GET['sellingPrice'];
$discount = $_GET['discount'];
$timeCharge = $_GET['timeCharge'];
$chargeBy = $_GET['chargeBy'];
$service = $_GET['service'];
$title = $_GET['title'];
$paidVia = $_GET['paidVia'];
$cashPaid = $_GET['cashPaid'];
$batchNo = $_GET['batchNo'];
$username = $_GET['username'];
$quantity = $_GET['quantity'];
$inventoryFrom = $_GET['inventoryFrom'];
$paycash = $_GET['paycash'];
$remarks = $_GET['remarks'];

if(isset($_GET['month']) && isset($_GET['day']) && isset($_GET['year']) ) {
	$month = $_GET['month'];
	$day = $_GET['day'];
	$year = $_GET['year'];
}else {
	$month ="";
	$day = "";
	$year= "";
}

$ro = new database();

$dateCharge = $year."-".$month."-".$day;

if($dateCharge == "--") {
$dateCharge = date("Y-m-d");
}else {
$dateCharge = $dateCharge;
}

?>
<!doctype html>
<html>
	<head>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
	</head>
	<body>
		<form method="post" action="therapyCharges1.php">
		<div class="container">
			<br>
			<h4><?php echo $description ?></h4>
			<div class="col-md-5">
				<div class="form-group">
					<label>Hospital</label>
					<input type='text' name="hospital" class="form-control" value="<?php echo $ro->selectNow('therapyCharges','hospital','chargesCode',$chargesCode) ?>">
				</div>
				<div class="form-group">
					<label>PF</label>
					<input type='text' name="pf" class="form-control" value="<?php echo $ro->selectNow('therapyCharges','pf','chargesCode',$chargesCode) ?>">
				</div>
				<div class="form-group">
					<label>Therapist</label>
					<select id="therapist" name="therapist" class="form-control">
						<option></option>
						<?php $ro->showOption("therapist","name") ?>
					</select>
				</div>
				<div class="form-group text-right">
					<input id="btn" type="submit" class="btn btn-success" value="Proceed >>">
				</div>
				<input type="hidden" name="status" value="<?php echo $status ?>">
				<input type="hidden" name="registrationNo" value="<?php echo $registrationNo ?>">
				<input type="hidden" name="chargesCode" value="<?php echo $chargesCode ?>">
				<input type="hidden" name="description" value="<?php echo $description ?>">
				<input type="hidden" name="sellingPrice" value="<?php echo $sellingPrice ?>">
				<input type="hidden" name="discount" value="<?php echo $discount ?>">
				<input type="hidden" name="timeCharge" value="<?php echo $timeCharge ?>">
				<input type="hidden" name="chargeBy" value="<?php echo $chargeBy ?>">
				<input type="hidden" name="service" value="<?php echo $service ?>">
				<input type="hidden" name="title" value="<?php echo $title ?>">
				<input type="hidden" name="paidVia" value="<?php echo $paidVia ?>">
				<input type="hidden" name="cashPaid" value="<?php echo $cashPaid ?>">
				<input type="hidden" name="batchNo" value="<?php echo $batchNo ?>">
				<input type="hidden" name="username" value="<?php echo $username ?>">
				<input type="hidden" name="quantity" value="<?php echo $quantity ?>">
				<input type="hidden" name="inventoryFrom" value="<?php echo $inventoryFrom ?>">
				<input type="hidden" name="paycash" value="<?php echo $paycash ?>">
				<input type="hidden" name="remarks" value="<?php echo $remarks ?>">
				<input type="hidden" name="dateCharge" value="<?php echo $dateCharge ?>"
			</div>
		</div>
		</form>
	</body>
</html>
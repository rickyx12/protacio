<?

	include "../../../myDatabase.php";
	include "../../../myDatabase4.php";
	
	$chargesCode = $_POST['chargesCode'];
	$date1 = $_POST['date1'];
	$date2 = $_POST['date2'];
	$title = $_POST['title'];

	$ro = new database();
	$ro4 = new database4();

	$ro4->count_charges_details($chargesCode,$date1,$date2,"OPD",$title);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="../../../bootstrap-3.3.6/css/bootstrap.css"></link>
	</head>
	<body>
		<div class="col-md-12">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Patient</th>
						<th>Total</th>
						<th>Time</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
					<? foreach( $ro4->count_charges_details_itemNo() as $itemNo ) { ?>
						<tr>
							<td>
								<?
									$registrationNo = $ro->selectNow("patientCharges","registrationNo","itemNo",$itemNo);
									$patientNo = $ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo);
									$lastName = $ro->selectNow("patientRecord","lastName","patientNo",$patientNo);
									$firstName = $ro->selectNow("patientRecord","firstName","patientNo",$patientNo);
									echo $registrationNo." - ".strtoupper($lastName).", ".strtoupper($firstName);
								?>
							</td>
							<td>
								<?
									$total = $ro->selectNow("patientCharges","total","itemNo",$itemNo);
									($total > 0) ? $x = number_format($total,2) : $x = "";
									echo $x;
								?>
							</td>
							<td>
								<?
									echo $ro4->formatTime($ro->selectNow("patientCharges","timeCharge","itemNo",$itemNo))
								?>
							</td>
							<td>
								<?
									echo $ro4->formatDate($ro->selectNow("patientCharges","dateCharge","itemNo",$itemNo))
								?>
							</td>
						</tr>
					<? } ?>
				</tbody>
			</table>
		</div>
	</body>
</html>
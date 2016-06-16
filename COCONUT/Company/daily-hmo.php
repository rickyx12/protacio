<? include "../../myDatabase.php" ?>
<? include "../../myDatabase4.php" ?>
<? $date = $_POST['date'] ?>
<? $shift = $_POST['shift'] ?>

<? $ro = new database() ?>
<? $ro4 = new database4() ?>

<? $grandTotal = 0 ?>

<? $ro4->daily_hmo_patient($date,$shift) ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Daily HMO</title>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
	</head>
	<body>
		<div class="container">
			<h3>HMO Patient</h3>
			<h5><? echo $ro4->formatDate($date)." - ".$shift ?></h5>
			<div class="col-sm-10">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Date</th>
						<th>Patient</th>
						<th>HMO</th>
						<th>Amount</th>
					</tr>
				</thead>
				<tbody>
					<? foreach( $ro4->daily_hmo_patient_registrationNo() as $registrationNo ) { ?>
						<tr>
							<td>
								<?
									echo $ro4->formatDate($ro->selectNow("registrationDetails","dateUnregistered","registrationNo",$registrationNo))
								?>
							</td>

							<td>
								<?
									$patientNo =  $ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo);
									$lastName = $ro->selectNow("patientRecord","lastName","patientNo",$patientNo);
									$firstName = $ro->selectNow("patientRecord","firstName","patientNo",$patientNo);

									echo $lastName.", ".$firstName;

								?>
							</td>

							<td>
								<?
									echo $ro->selectNow("registrationDetails","Company","registrationNo",$registrationNo)
								?>
							</td>

							<td>
								<?
									$amount = $ro4->outpatient_hmo_total($registrationNo,$shift);
									$grandTotal += $amount;
									echo number_format($amount,2);
								?>
							</td>

						</tr>
					<? } ?>
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td><? echo number_format($grandTotal,2) ?></td>
					</tr>
				</tfoot>
			</table>
			</div>
		</div>
	</body>
</html>
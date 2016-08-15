<?
	include "../../../myDatabase.php";
	include "../../../myDatabase4.php";

	$date1 = $_POST['date1'];
	$date2 = $_POST['date2'];

	$ro = new database();
	$ro4 = new database4();

	$phicTotal = 0;
	$totalPatient = 0;

	$ro4->outpatient_discharged($date1,$date2);

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="../../../bootstrap-3.3.6/css/bootstrap.css"></link>
	</head>
	<body>
		<div class="container">
			<h3>Philhealth Receivables</h3>
			<h5>Outpatient</h5>
			<h5><? echo $ro4->formatDate($date1)." - ".$ro4->formatDate($date2) ?></h5>

			<div class="col-md-8">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Patient</th>
							<th>Admitted</th>
							<th>Receivables</th>
						</tr>
					</thead>
					<tbody>
						<? foreach( $ro4->outpatient_discharged_registrationNo() as $registrationNo ) { ?>
							<?
								$phic = round( ($ro4->inpatient_paymentMode_total_charges($registrationNo,"phic") + $ro4->inpatient_paymentMode_total_inventory($registrationNo,"phic")) ,2);

								$patientType = $ro->selectNow("registrationDetails","type","registrationNo",$registrationNo);	
							?>
								<? if( $phic > 0 ) { ?>
									<tr>
										<td>
											<?
												$patientNo = $ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo);
												$lastName = $ro->selectNow("patientRecord","lastName","patientNo",$patientNo);
												$firstName = $ro->selectNow("patientRecord","firstName","patientNo",$patientNo);
												echo strtoupper($lastName).", ".strtoupper($firstName);
												$totalPatient += 1;
											?>
										</td>
										<td>
											<?
												$admission = $ro->selectNow("registrationDetails","dateRegistered","registrationNo",$registrationNo);
												$discharged = $ro->selectNow("registrationDetails","dateUnregistered","registrationNo",$registrationNo);
												echo $ro4->formatDate($admission)." - ".$ro4->formatDate($discharged);
											?>
										</td>
										<td>
											<?
												echo number_format($phic);
												$phicTotal += $phic;
											?>
										</td>
									</tr>
							<? }else { } ?>
						<? } ?>
					</tbody>
					<tfoot>
						<tr>
							<th><? echo $totalPatient." Patients" ?></th>
							<th></th>
							<th><? echo number_format($phicTotal,2) ?></th>
						</tr>
					</tfoot>
				</table>
			</div>

		</div>
	</body>
</html>
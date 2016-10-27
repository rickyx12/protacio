<?
include "../../myDatabase.php";
include "../../myDatabase4.php";
$doctorCode = $_POST['doctorCode'];
$date = $_POST['date'];

$ro = new database();
$ro4 = new database4();

$patients = 0;
$totalPF = 0;

$ro4->get_doctor_outpatient_completed($doctorCode,$date);

?>
<!DOCTYPE html>
<html>
	<head>
	  <meta charset="UTF-8">
	  <script src="../../bower_components/jquery/dist/jquery.min.js"></script>
	  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
	  <link rel="stylesheet" href="../../bower_components/semantic/dist/semantic.min.css">

	  <style>

	 	#patients {
	 		margin-top:5%;
	 	}

	  </style>

	</head>
	<body>
		<div class="container">
			<div class="col-md-3">
				
			</div>

			<div class="col-md-6">
				<table id="patients" class="ui selectable celled table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Prof Fee</th>
						</tr>
					</thead>
					<tbody>
						<? if( $ro4->get_doctor_outpatient_completed_registrationNo() != "" ) { ?>
							<? foreach( $ro4->get_doctor_outpatient_completed_registrationNo() as $registrationNo ) { ?>
								<tr>
									<td>
										<?
											$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
											$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
											$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
											echo ucfirst(strtolower($lastName)).", ".ucfirst(strtolower($firstName));
											$patients += 1;
										?>
									</td>
									<td>
										<?
											$itemNo = $ro4->get_current_doctor($registrationNo,$doctorCode);
											$pf = $ro->selectNow("patientCharges","total","itemNo",$itemNo);
											echo number_format($pf,2);
											$totalPF += $pf;
										?>
									</td>
								</tr>
							<? } ?>
						<? }else { } ?>
					</tbody>
					<tfoot>
						<tr>
							<th>
								<? echo $patients ?> Patients
							</th>
							<th>
								<? echo number_format($totalPF,2) ?>
							</th>
						</tr>
					</tfoot>
				</table>
			</div>

			<div class="col-md-3">
				
			</div>

		</div>
	</body>
</html>
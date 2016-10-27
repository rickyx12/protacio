<?
include "../../../../myDatabase.php";
include "../../../../myDatabase4.php";

$date1 = $_POST['date1'];
$date2 = $_POST['date2'];
$title = $_POST['title'];

$ro = new database();
$ro4 = new database4();

$patientCount = 0; //ilan patient
$seniorNo = 0; //ilan nka tag n senior
$discountNo = 0; //ilan ung mya discount

$ro4->laboratory_senior_patient($date1,$date2,"OPD",$title);

?>
<!DOCTYPE html>
<html>
	<head>
	  <meta charset="UTF-8">
	  <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
			<h3> <? echo $title ?> </h3>
			<h5><? echo $ro4->formatDate($date1) ?> - <? echo $ro4->formatDate($date2) ?></h5>
			<div class="col-md-2">
				
			</div>

			<div class="col-md-8">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Patient</th>
							<th>Age</th>
							<th>Senior</th>
							<th>Discount</th>
						</tr>
					</thead>
					<tbody>
						<? foreach( $ro4->laboratory_senior_patient_itemNo() as $itemNo )  { ?>
							<tr>
								<td>
									<?
										$registrationNo = $ro->selectNow('patientCharges','registrationNo','itemNo',$itemNo);
										$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
										$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
										$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
										echo $ro4->formatLetter($lastName).", ".$ro4->formatLetter($firstName);
										$patientCount += 1;
									?>
								</td>
								<td>
									<?
										$registrationNo = $ro->selectNow('patientCharges','registrationNo','itemNo',$itemNo);
										$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
										echo $ro->selectNow('patientRecord','Age','patientNo',$patientNo);										
									?>
								</td>
								<td>
									<?
										$registrationNo = $ro->selectNow('patientCharges','registrationNo','itemNo',$itemNo);
										$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
										$senior = $ro->selectNow('patientRecord','Senior','patientNo',$patientNo);

										if( $senior == "YES" ) {
											echo "<i class='glyphicon glyphicon-ok'></i>";
											$seniorNo += 1;
										}else {
											echo "";
										}

									?>
								</td>
								<td>
									<?
										$registrationNo = $ro->selectNow('patientCharges','registrationNo','itemNo',$itemNo);
										$disc = $ro4->laboratory_senior_patient_discount($registrationNo);

										if( $disc > 0 ) {
											$d = number_format($disc,2);
											$discountNo += 1;
										}else {
											$d = "";
										}

										echo $d;

									?>
								</td>
							</tr>
						<? } ?>
					</tbody>
					<tfoot>
						<tr>
							<td><? echo $patientCount." Patients" ?></td>
							<td></td>
							<td><? echo $seniorNo ?></td>
							<td><? echo $discountNo ?></td>
						</tr>
					</tfoot>
				</table>
			</div>

			<div class="col-md-2">
				
			</div>

		</div>
	</body>
</html>
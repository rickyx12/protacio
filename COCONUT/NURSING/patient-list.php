<?
	require_once "../authentication.php";
	include "../../myDatabase2.php";
	include "../../myDatabase4.php";

	$ro = new database();
	$ro2 = new database2();
	$ro4 = new database4();

	$ro4->room_list();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<script src="../js/open.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script>
			$(document).ready(function(){
				
				<? if( $ro4->room_list_description() != "" ) { ?>
					<? foreach( $ro4->room_list_description() as $description ) { ?> 
						<? $ro2->currentAdmittedPatient($description) ?>

						$("#viewPatient<? echo $ro2->currentAdmittedPatient_registrationNo() ?>").click(function(){
							var data = {
								username:'<? echo $ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']) ?>',
								registrationNo:'<? echo $ro2->currentAdmittedPatient_registrationNo() ?>'
							};
							open("POST","../currentPatient/patientInterface1.php",data,"_blank");
						});

					<? } ?>
				<? }else { } ?>

			});
		</script>

	</head>
	<body>
		<div class="container">
			<br><br>
			<div class="col-md-8">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Room</th>
							<th>Patient</th>
							<th>Admission</th>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<? foreach( $ro4->room_list_description() as $description ) { ?>
							<? $ro2->currentAdmittedPatient($description) ?>
							<tr>
								<td>
									<?
										echo $description
									?>
								</td>
								<td>
									<?
										echo $ro2->currentAdmittedPatient_name()
									?>
								</td>
								<td>
									<?
										$dateAdmitted = $ro2->selectNow("registrationDetails","dateRegistered","registrationNo",$ro2->currentAdmittedPatient_registrationNo());
										( $dateAdmitted != "" ) ? $x = $ro4->formatDate($dateAdmitted) : $x = "";
										echo $x;
									?>
								</td>
								<td>
									<? if( $dateAdmitted != "" ) { ?>
									<button id="viewPatient<? echo $ro2->currentAdmittedPatient_registrationNo() ?>" class="btn btn-success" >
										<i class="glyphicon glyphicon-user"></i>
										View
									</button>
									<? }else { } ?>
								</td>
							</tr>
						<? } ?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>
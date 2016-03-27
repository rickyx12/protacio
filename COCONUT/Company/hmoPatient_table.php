<?php
include "../../myDatabase4.php"; 
include "../../myDatabase.php";

$reportDate = $_POST["date"];

$ro = new database4();
$ro1 = new database();
$reportDate;



?>

<!doctype html>
<html>
<head>
		<title>HMO SHIFTING</title>
		<script language="javascript" src="../js/jquery-2.1.4.min.js"></script>
		<script langugae="javascript" src="../js/jquery-ui.min.js"></script>
		<script language="javascript" src="../../bootstrap-3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<link rel="stylesheet" href="../js/jquery-ui.css"></link>
		<link rel="stylesheet" href="../js/jquery-ui.theme.min.css"></link>
		<style>
			#patientName {
				text-decoration: none;
				color:black;
			}
		</style>	
		<script>
				<?php $ro->get_hmo_patient($reportDate,$reportDate) ?>
				<?php foreach($ro->get_hmo_patient_registrationNo() as $registrationNo) { ?>
						$("#myModal<?php echo $registrationNo ?>").on("show.bs.modal",function() {

						});

				$(document).on("click","#saveBtn<?php echo $registrationNo ?>",function() {
					//console.log("asas");
					var reg = $("#reg<?php echo $registrationNo ?>").val();
					var shift = $("input[name=shift]:checked").val();

					$.post("hmoPatient_setShift.php",{registrationNo:reg,shift:shift},function(data) {
						$("#patient").load("hmoPatient_table.php");
					});
				});						
				<?php } ?>			

		</script>
</head>
<body>
<form method="post" action="hmoPatient_setShift_manual.php">
<div class="container">
		<?php $ro->get_hmo_patient($reportDate,$reportDate) ?>

		<div class="col-md-10">
			<table class="table table-hover">
				<thead>
					<th></th>
					<th>Patient</th>
					<th>HMO</th>
					<th>Receivables</th>
					<th>Shift</th>
					<th>Register</th>
					<th>Check out</th>
				</thead>
				<tbody>
			<?php foreach($ro->get_hmo_patient_registrationNo() as $registrationNo) { ?>
			<?php $patientNo = $ro1->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo) ?>
			
			
					<tr>
						<td><input type="checkbox" class="form-control" name="registrationNo[]" value="<?php echo $registrationNo ?>"></td>
						<td><a id="patientName" data-toggle="modal" data-target="#chargesModal<?php echo $registrationNo ?>" href="#"><?php echo $ro1->selectNow("patientRecord","lastName","patientNo",$patientNo) ?>, <?php echo $ro1->selectNow("patientRecord","firstName","patientNo",$patientNo) ?></a></td>
						<td><?php echo $ro1->selectNow("registrationDetails","Company","patientNo",$patientNo) ?></td>
						<td><?php echo number_format($ro->get_hmo_patient_total($registrationNo),2) ?></td>
						<td><?php echo $ro->get_hmo_charges_getShift($registrationNo) ?></td>
						<td><?php echo $ro1->selectNow("registrationDetails","dateRegistered","registrationNo",$registrationNo) ?></td>
						<td><?php echo $ro1->selectNow("registrationDetails","dateUnregistered","registrationNo",$registrationNo) ?></td>
					</tr>
			
			<?php $patient = $ro1->selectNow("patientRecord","lastName","patientNo",$patientNo).", ".$ro1->selectNow("patientRecord","firstName","patientNo",$patientNo) ?>
			<?php getCharges($registrationNo,$patient) ?>
			<?php $ro->get_hmo_charges($registrationNo) ?>				
			<?php } ?>
				</tbody>
			</table>
		</div>

					<?php function getCharges($registrationNo,$pxName) { ?>
					<input type="hidden" id="reg<?php echo $registrationNo ?>" value="<?php echo $registrationNo ?>">
					<div id="chargesModal<?php echo $registrationNo ?>" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title"><?php echo $pxName ?></h4>
								</div>
								<div class="modal-body">
									<div class="radio">
										<label><input type="radio" name="shift" value="Morning">Morning</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="shift" value="Noon">Noon</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="shift" value="Afternoon">Afternoon</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="shift" value="Night">Night</label>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="button" id="saveBtn<?php echo $registrationNo ?>" class="btn btn-success" data-dismiss="modal">Save</button>
								</div>
							</div>
						</div>
					</div>	

					<script>
					</script>

					<?php } ?>

</div>
<div class="container">
<div class="col-md-8">
<label class="radio-inline"><input type="radio" name="shift" value="Morning">Morning</label>
<label class="radio-inline"><input type="radio" name="shift" value="Noon">Noon</label>
<label class="radio-inline"><input type="radio" name="shift" value="Afternoon">Afternoon</label>
<label class="radio-inline"><input type="radio" name="shift" value="Night">Night</label>
</div>

<div class="col-md-4">
<input type="hidden" name="reportDate" value="<?php echo $reportDate ?>">
 <button type="submit" class="btn btn-success">Add Shift >></button>
</div>
</div>
</form>
<Br>
</body>
</html>
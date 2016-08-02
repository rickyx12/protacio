<?
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$inventoryLocation = $_POST['inventoryLocation'];

	$ro = new database();
	$ro4 = new database4();

	$ro4->dept_dispense($inventoryLocation);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<script src="../../bootstrap-3.3.6/js/bootstrap.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script>
			$(document).ready(function(){

					<? foreach( $ro4->dept_dispense_registrationNo() as $registrationNo ) { ?>
						<? $ro4->dept_dispense_patient($registrationNo,$inventoryLocation) ?>
							<? foreach( $ro4->dept_dispense_patient_itemNo() as $itemNo ) { ?>
								$("#dispenseBtn<? echo $itemNo ?>").click(function(){ 
									
						            var itemNo = $('input[name=itemNo]:checked').map(function() {
						                return $(this).val();
						            }).get();

									$.post("to-dispense-dept-update.php",{itemNo:itemNo},function(result){
										window.parent.location = document.referrer;
									});
								});
							<? } ?>
					<? } ?>
				

			});
		</script>
	</head>
	<body>
		<div class="container">
			<h3>Dispensing</h3>
			<div class="col-md-6">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Patient</th>
							<th>Room</th>
							<th>Admitted</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<? foreach( $ro4->dept_dispense_registrationNo() as $registrationNo ) { ?>
							<tr>
								<td>
									<?
										$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
										$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
										$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
										echo strtoupper($lastName.", ".$firstName);
									?>
								</td>
								<td>
									<?
										echo $ro->selectNow('registrationDetails','room','registrationNo',$registrationNo)
									?>
								</td>
								<td>
									<?
										echo $ro4->formatDate($ro->selectNow('registrationDetails','dateRegistered','registrationNo',$registrationNo))
									?>
								</td>
								<td>
									<button class="btn btn-success" data-toggle="modal" data-target="#dispenseModal<? echo $registrationNo ?>">
										View 
									</button>
								</td>
							</tr>
						<? } ?>
					</tbody>
				</table>
			</div>
			<? foreach( $ro4->dept_dispense_registrationNo() as $registrationNo ) { ?>
				<? //$ro4->dept_dispense_patient($registrationNo,$inventoryLocation) //ung call s function n e2 nsa taas s may jquery ?>
				<div id="dispenseModal<? echo $registrationNo ?>" class="modal fade" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">
									<?
										$patientNo = $ro->selectNow('registrationDetails','patientNo','registrationNo',$registrationNo);
										$lastName = $ro->selectNow('patientRecord','lastName','patientNo',$patientNo);
										$firstName = $ro->selectNow('patientRecord','firstName','patientNo',$patientNo);
										echo strtoupper($lastName.", ".$firstName);
									?>
								</h4>
							</div>
							<div class="modal-body">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Particulars</th>
											<th>QTY</th>
											<th>Details</th>
											<th>User</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<? foreach( $ro4->dept_dispense_patient_itemNo() as $itemNo ) { ?>
											<tr>
												<td>
													<? if( $ro->selectNow('patientCharges','title','itemNo',$itemNo) == "MEDICINE" ) { ?>
														<?
															$inventoryCode = $ro->selectNow('patientCharges','chargesCode','itemNo',$itemNo);
															echo $ro->selectNow('inventory','genericName','inventoryCode',$inventoryCode);
														?>
														<h6>
															<?
																echo $ro->selectNow('patientCharges','description','itemNo',$itemNo)
															?>
														</h6>
													<? }else { ?>
														<?
															echo $ro->selectNow('patientCharges','description','itemNo',$itemNo)
														?>
													<? } ?>
												</td>
												<td>
													<?
														echo $ro->selectNow('patientCharges','quantity','itemNo',$itemNo)
													?>
												</td>
												<td>
													<?
														echo $ro4->formatDate($ro->selectNow('patientCharges','dateCharge','itemNo',$itemNo))
													?>
													<h6>
														<?
															echo $ro4->formatTime($ro->selectNow('patientCharges','timeCharge','itemNo',$itemNo))
														?>
													</h6>
												</td>
												<td>
													<?
														echo $ro->selectNow('patientCharges','chargeBy','itemNo',$itemNo)
													?>
												</td>
												<td>
													<input type="checkbox" name="itemNo" class="form-control" value="<? echo $itemNo ?>" checked="true">
												</td>
											</tr>
										<? } ?>
									</tbody>
								</table>
							</div>
								<div class="modal-footer">
									<button class="btn btn-danger" data-dismiss="modal">Close</button>
									<button class="btn btn-success" id="dispenseBtn<? echo $itemNo ?>" data-dismiss="modal">Dispense</button>
								</div>					
						</div>
					</div>
				</div>
			<? } ?>
		</div>
	</body>
</html>
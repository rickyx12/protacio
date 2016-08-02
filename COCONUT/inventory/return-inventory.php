<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$inventoryLocation = $_POST['inventoryLocation'];

	$ro = new database();
	$ro4 = new database4();

	$ro4->get_return_inventory($inventoryLocation);

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

				<? foreach( $ro4->get_return_inventory_registrationNo() as $registrationNo ) { ?>
					$(document).ready(function(){
						$("#returnBtn<? echo $registrationNo ?>").click(function(){
							
							var itemNo = $('input[name=itemNo]:checked').map(function(){
								return this.value;
							}).get();

							$.post("return-inventory-update.php",{itemNo:itemNo},function(result){
								window.parent.location = document.referrer;
								//console.log(result);
							});
						});
					});
				<? } ?>

			});

		</script>

	</head>
	<body>
		<div class="container">
			<h3>Return Inventory</h3>
			<div class="col-md-6">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Patient</th>
							<th>Room</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<? foreach( $ro4->get_return_inventory_registrationNo() as $registrationNo ) { ?>
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
									<button class="btn btn-success" data-toggle="modal" data-target="#returnModal">
										View
									</button>
								</td>
							</tr>
						<? } ?>
					</tbody>
				</table>
				<? foreach( $ro4->get_return_inventory_registrationNo() as $registrationNo ) { ?>
					<? $ro4->get_return_inventory_item($registrationNo,$inventoryLocation) ?>
					<div id="returnModal" class="modal fade" role="dialog">
						<div class="modal-dialog">
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
												<th></th>
											</tr>
										</thead>
										<tbody>
											<? foreach( $ro4->get_return_inventory_itemNo() as $itemNo ) { ?>
												<tr>
													<td>
														<?
															$inventoryCode = $ro->selectNow('patientCharges','chargesCode','itemNo',$itemNo);
															$genericName = $ro->selectNow('inventory','genericName','inventoryCode',$inventoryCode);
															echo $genericName;
														?>
															<h6>
																<?
																	echo $ro->selectNow('patientCharges','description','itemNo',$itemNo)
																?>
														</h6>
													</td>
													<td>
														<?
															$return = $ro->selectNow('patientCharges','departmentStatus','itemNo',$itemNo);
															$qty = $date1 = preg_split ("/\_/", $return);
															echo $qty[0];
														?>
													</td>
													<td>
														<input type="checkbox" name="itemNo" class="form-control" value="<? echo $itemNo ?>" checked="true" >
													</td>
												</tr>
											<? } ?>
										</tbody>
									</table>
								</div>
								<div class="modal-footer">
									<button class="btn btn-danger" data-dismiss="modal">
										Close
									</button>								
									<button class="btn btn-success" id="returnBtn<? echo $registrationNo ?>" data-dismiss="modal">
										Return
									</button>
								</div>
							</div>
						</div>
					</div>
				<? } ?>
			</div>
		</div>
	</body>
</html>
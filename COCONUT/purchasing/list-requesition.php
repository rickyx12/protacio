<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$ro = new database();
	$ro4 = new database4();
	$ro4->list_requesition();
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

				<? foreach( $ro4->list_requesition_batchNo() as $batchNo ) { ?>
					<? $ro4->pending_request_details($batchNo) ?>
					$("#issueBtn<? echo $batchNo ?>").click(function(){

						<? foreach( $ro4->pending_request_details_verificationNo() as $verificationNo ) { ?>
						var verificationNo = $('input[name=verificationNo<? echo $verificationNo ?>]:checked').val();
						var batchNo = '<? echo $batchNo ?>';

						var data = {
							verificationNo:verificationNo,
							batchNo:batchNo
						};

							$.post("issue-requesition.php",data,function(result){
								location.reload();
							});
						<? } ?>

					});
				<? } ?>

			});
		</script>

	</head>
	<body>
		<div class="container">
			<h3>&nbsp;</h3>
			<div class="col-md-10">
				<? if( $ro4->list_requesition_batchNo() != "" ) { ?>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Request#</th>
								<th>Department</th>
								<th>Request By</th>
								<th>Time</th>
								<th>Date</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<? foreach( $ro4->list_requesition_batchNo() as $batchNo ) { ?>
								<tr>
									<td>
										<?
											echo $batchNo
										?>
									</td>
									<td>
										<?
											echo $ro->selectNow("inventoryManager","requestingDepartment","batchNo",$batchNo)
										?>
									</td>
									<td>
										<?
											echo $ro->selectNow("inventoryManager","requestingUser","batchNo",$batchNo)
										?>
									</td>
									<td>
										<?
											echo $ro4->formatTime($ro->selectNow("inventoryManager","timeRequested","batchNo",$batchNo))
										?>
									</td>
									<td>
										<?
											echo $ro4->formatDate($ro->selectNow("inventoryManager","dateRequested","batchNo",$batchNo))
										?>
									</td>
									<td>
										<button class="btn btn-success col-sm-9" data-toggle="modal" data-target="#requestModal<? echo $batchNo ?>">View Request</button>
									</td>
								</tr>
							<? } ?>
						</tbody>
					</table>
				<? }else { ?>
					<h2>No Request</h2>
				<? } ?>
			</div>
			<? if( $ro4->list_requesition_batchNo() != "" ) { ?>
				<? foreach( $ro4->list_requesition_batchNo() as $batchNo ) { ?>
					<? $ro4->pending_request_details($batchNo) ?>
					<div id="requestModal<? echo $batchNo ?>" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Request from <? echo $ro->selectNow("inventoryManager","requestingDepartment","batchNo",$batchNo) ?> by <? echo $ro->selectNow("inventoryManager","requestingUser","batchNo",$batchNo) ?> </h4>
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
											<? foreach( $ro4->pending_request_details_verificationNo() as $verificationNo ) { ?>
												<tr>
													<td>
														<? if( $ro->selectNow("inventoryManager","inventoryType","verificationNo",$verificationNo) == "medicine") { ?>
															<?
																echo $ro->selectNow("inventoryManager","genericName","verificationNo",$verificationNo)
															?>
															<h6>
																<?
																	echo $ro->selectNow("inventoryManager","description","verificationNo",$verificationNo)
																?>
															</h6>
														<? }else { ?>
															<?
																echo $ro->selectNow("inventoryManager","description","verificationNo",$verificationNo)
															?>
														<? } ?>
													</td>
													<td>
														<?
															echo $ro->selectNow("inventoryManager","quantity","verificationNo",$verificationNo)
														?>
													</td>
													<td>
														<input type="checkbox" name="verificationNo<? echo $verificationNo ?>" class="form-control" value="<? echo $verificationNo ?>" checked="true" >
													</td>
												</tr>
											<? } ?>
										</tbody>
									</table>
								</div>
								<div class="modal-footer">
									<button class="btn btn-danger" data-dismiss="modal">Cancel Request</button>
									<button id="issueBtn<? echo $batchNo ?>" class="btn btn-success" data-dismiss="modal">Issue Request</button>
								</div>
							</div>
						</div>
					</div>
				<? } ?>
			<? }else { }?>
		</div>
	</body>
</html>
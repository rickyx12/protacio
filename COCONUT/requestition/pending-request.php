<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$module = $_POST['module'];

	$ro = new database();
	$ro4 = new database4();

	$ro4->pending_request($module);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<script src="../js/jquery-ui.js"></script>
		<script src="../js/jquery.tooltipster.min.js"></script>
		<script src="../js/open.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<link rel="stylesheet" href="../myCSS/jquery-ui.css"></link>
		<link rel="stylesheet" href="../myCSS/tooltipster.css"></link>
		<link rel="stylesheet" href="../myCSS/tooltipster-noir.css"></link>

		<script>
			$(document).ready(function(){


				<? foreach( $ro4->pending_request_batchNo() as $batchNo ) { ?>
					$(".details<? echo $batchNo ?>").tooltipster({
						content: $('<span>Loading....</span>'),
						position: 'right',
						theme: 'tooltipster-noir',
						contentAsHTML:true,
						functionBefore:function(origin,continueTooltip) {
							continueTooltip();
							if( origin.data('ajax') !== 'cached' ){ 
								$.ajax({
									type:'POST',
									url:'pending-request-details.php',
									data:{'batchNo':'<? echo $batchNo ?>'},
									success:function(data) {
										origin.tooltipster('content',data).data('ajax','cached');
									}
								});
							}
						}					
					});


					$("#removeBtn<? echo $batchNo ?>").click(function(){
						$.post("delete-pending-request.php",{batchNo:<? echo $batchNo ?>},function(){
							open("POST","pending-request.php",{module:'<? echo $module ?>'},"_self");
						});
					});

				<? } ?>

			});			
		</script>

	</head>
	<body>
		<div class="container">
			<br>
			<h3>Pending Request</h3>
			<div class="col-md-6">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Batch#</th>
							<th>Date</th>
							<th>Request By</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<? foreach( $ro4->pending_request_batchNo() as $batchNo ) { ?>
							<tr>
								<td>
									<span class="details<? echo $batchNo ?>">
										<?
											echo $batchNo
										 ?>
									 </span>
								</td>
								<td>
									<span class="details<? echo $batchNo ?>">
										<?
											echo $ro4->formatDate($ro->selectNow("inventoryManager","dateRequested","batchNo",$batchNo))
										?>
									</span>
								</td>
								<td>
									<span class="details<? echo $batchNo ?>">
										<?
											echo $ro->selectNow("inventoryManager","requestingUser","batchNo",$batchNo)
										?>
									</span>
								</td>
								<td>
									<button id="removeBtn<? echo $batchNo ?>" class="btn btn-danger">Remove</button>
								</td>
							</tr>
						<? } ?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>
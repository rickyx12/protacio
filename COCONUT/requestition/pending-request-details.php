<?

	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$batchNo = $_POST['batchNo'];
	
	$ro = new database();
	$ro4 = new database4();

	$ro4->pending_request_details($batchNo);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
	</head>
	<body>
		
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Particulars</th>
						<th>QTY</th>
					</tr>
				</thead>
				<tbody>
					<? foreach( $ro4->pending_request_details_verificationNo() as $verificationNo ) { ?>
						<tr>
							<td>
								
								<? if( $ro->selectNow("inventoryManager","inventoryType","verificationNo",$verificationNo) == "medicine" ) { ?>
									<?
										echo $ro->selectNow("inventoryManager","genericName","verificationNo",$verificationNo)
									?>
									<h6 style="color:red;">
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
						</tr>
					<? } ?>
				</tbody>
			</table>
		
	</body>
</html>
<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	include "../../myDatabase4.php";
	$searchValue = $_POST['searchValue'];
	$requesitionNo = $_POST['requesitionNo'];

	$ro = new database();
	$ro4 = new database4();

	$ro4->search_stock_room($searchValue);

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script type="text/javascript">
			$(document).ready(function(){

				<? if( $ro4->search_stock_room_inventoryCode() != "" ) { ?>
					<? foreach( $ro4->search_stock_room_inventoryCode() as $inventoryCode ) { ?>
						$("#requestBtn<? echo $inventoryCode ?>").click(function(){

							var requestQTY<? echo $inventoryCode ?> = $("#requestQTY<? echo $inventoryCode ?>").val();

							var data = {
								inventoryCode:<? echo $inventoryCode ?>,
								requesitionNo:<? echo $requesitionNo ?>,
								requestQTY:requestQTY<? echo $inventoryCode ?>
							}

							$.post("add-request.php",data,function(result){
								location.reload();
							});
						});

						var currentQTY = $("#currentQTY<? echo $inventoryCode ?>").val();
						var qty = parseInt(currentQTY);

						$('#requestQTY<? echo $inventoryCode ?>').jStepper({
							minValue:1,
							maxValue:qty,
							});

					<? } ?>
				<? } ?>

			});
		</script>
	</head>
	<body>
		<h5>&nbsp;</h5>
		<div class="container">
			<div class="col-md-6">
				<table id="result" class="table table-hover">
					<thead>
						<tr>
							<th>Particulars</th>
							<th>QTY</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<? if( $ro4->search_stock_room_inventoryCode() != "" ) { ?>
							<? foreach( $ro4->search_stock_room_inventoryCode() as $inventoryCode ) { ?>
								<tr>
									<td width="50%">
										<div class="col-md-12">
											<? if( $ro->selectNow("inventory","inventoryType","inventoryCode",$inventoryCode) == "medicine" ) { ?>
												<? echo $ro->selectNow("inventory","genericName","inventoryCode",$inventoryCode) ?>
												<br>
												<h6>
													<? echo $ro->selectNow("inventory","description","inventoryCode",$inventoryCode) ?>
												</h6>
											<? }else { ?>
												<? echo $ro->selectNow("inventory","description","inventoryCode",$inventoryCode) ?>
											<? } ?>
										</div>
									</td>
									<td width="15%">
										<? 
											echo $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode) 
										?>
										<input type="hidden" id="currentQTY<? echo $inventoryCode ?>" value="<? echo $ro->selectNow('inventory','quantity','inventoryCode',$inventoryCode) ?>">
									</td>
									<td width="35%">
										
										<div class="col-sm-12">
											<div class="input-group input-group-sm">
												<span class="input-group-addon">QTY</span>
												<input type="text" id="requestQTY<? echo $inventoryCode ?>" class="form-control" value="1">
												<span class="input-group-btn">
													<input id="requestBtn<? echo $inventoryCode ?>" type="button" class="btn btn-success" value="Add">
												</span>
											</div>
										</div>
										
										<!--
										<input type="button" id="requestBtn<? echo $inventoryCode ?>" class="btn btn-success" value="Request">
										-->
									</td>
								</tr>
							<? } ?>
						<? } ?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>
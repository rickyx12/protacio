<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$desc = $_POST['desc'];
	$inventoryLocation = $_POST['inventoryLocation'];
	$batchNo = $_POST['batchNo'];
	$registrationNo = $_POST['registrationNo'];

	$ro = new database();
	$ro4 = new database4();

	$ro4->search_inventory($desc,$inventoryLocation);

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/open.js"></script>
		<script src="../js/jquery.jstepper.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script>
		
			$(document).ready(function(){

				<? foreach( $ro4->search_inventory_inventoryCode() as $inventoryCode ) { ?>

					var qty = "<? echo $ro->selectNow('inventory','quantity','inventoryCode',$inventoryCode) ?>";
					var qty1 = parseInt(qty);

					$('#chargeQTY<? echo $inventoryCode ?>').jStepper({
						minValue:1, 
						maxValue:qty1
					});

					$("#chargeBtn<? echo $inventoryCode ?>").click(function(){
						
						var inventoryCode = '<? echo $inventoryCode ?>';
						var qty = $("#chargeQTY<? echo $inventoryCode ?>").val();
						var batchNo = '<? echo $batchNo ?>';
						var registrationNo = '<? echo $registrationNo ?>';

						var data = {
							inventoryCode:inventoryCode,
							qty:qty,
							batchNo:batchNo,
							registrationNo:registrationNo
						};

						$.post('dept-charges-search-add.php',data,function(result){
							console.log(result);
							var data = {
								inventoryLocation:'<? echo $inventoryLocation ?>',
								batchNo:batchNo,
								registrationNo:registrationNo
							};

							open('POST','dept-charges.php',data,'_self');
						});

					});
				<? } ?>

			});

		</script>
	</head>
	<body>
		<div class="container">
			<div class="col-md-7">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Particulars</th>
							<th>QTY</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<? foreach( $ro4->search_inventory_inventoryCode() as $inventoryCode ) { ?>
							<tr>
								<td width="50%">
									<? if( $ro->selectNow('inventory','inventoryType','inventoryCode',$inventoryCode) == "medicine" ) { ?>
									<?
										echo $ro->selectNow('inventory','genericName','inventoryCode',$inventoryCode)
									?>
									<h6>
										<?
											echo $ro->selectNow('inventory','description','inventoryCode',$inventoryCode)
										?>
									</h6>
									<? }else { ?>
										<?
											echo $ro->selectNow('inventory','description','inventoryCode',$inventoryCode)
										?>
									<? } ?>
								</td>
								<td width="15%">
									<?
										echo $ro->selectNow('inventory','quantity','inventoryCode',$inventoryCode)
									?>
								</td>
								<td width="35%">
									<div class="col-sm-12">
										<div class="input-group input-group-sm">
											<span class="input-group-addon">QTY</span>
											<input type="text" id="chargeQTY<? echo $inventoryCode ?>" class="form-control" value="1">
											<span class="input-group-btn">
												<input id="chargeBtn<? echo $inventoryCode ?>" type="button" class="btn btn-success" value="Add">
											</span>
										</div>										
									</div>
								</td>
							</tr>
						<? } ?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>
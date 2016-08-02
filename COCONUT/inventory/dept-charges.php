<? 
	require_once "../authentication.php";
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$inventoryLocation = $_POST['inventoryLocation']; 
	$batchNo = $_POST['batchNo'];
	$registrationNo = $_POST['registrationNo'];

	$pharmacyClass = "";
	$nursingClass = "";
	$orClass = "";
	$erClass = "";

	$ro = new database();
	$ro4 = new database4();

	$ro4->charges_cart($batchNo,$registrationNo);


	if( $inventoryLocation == "PHARMACY" ) {
		$pharmacyClass = "btn btn-success";
	}else {
		$pharmacyClass = "btn btn-default";
	}

	if( $inventoryLocation == "NURSING" ) {
		$nursingClass = "btn btn-success";
	}else {
		$nursingClass = "btn btn-default";
	}

	if( $inventoryLocation == "OR" ) {
		$orClass = "btn btn-success";
	}else {
		$orClass = "btn btn-default";
	}

	if( $inventoryLocation == "E.R" ) {
		$erClass = "btn btn-success";
	}else {
		$erClass = "btn btn-default";
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<script src="../js/open.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<link rel="stylesheet" href="../myCSS/font-awesome-4.6.3/css/font-awesome.min.css"></link>

		<script>
			$(document).ready(function() {

				$("#searchBox").keypress(function(event){
					if( event.which == 13 ) {
						var desc = $("#searchBox").val();
						var inventoryLocation = '<? echo $inventoryLocation ?>';
						var batchNo = '<? echo $batchNo ?>';
						var registrationNo = '<? echo $registrationNo ?>';

						var data = {
							desc:desc,
							inventoryLocation:inventoryLocation,
							batchNo:batchNo,
							registrationNo:registrationNo
						};	

						$.post("dept-charges-search.php",data,function(result){
							$("#result").html(result);
						});
					}
				});


				$("#searchInventory").click(function(){

					var desc = $("#searchBox").val();
					var inventoryLocation = '<? echo $inventoryLocation ?>';
					var batchNo = '<? echo $batchNo ?>';
					var registrationNo = '<? echo $registrationNo ?>';
					var data = {
						desc:desc,
						inventoryLocation:inventoryLocation,
						batchNo:batchNo,
						registrationNo:registrationNo
					};	

					$.post("dept-charges-search.php",data,function(result){
						$("#result").html(result);
					});
				});

				<? if( $ro4->charges_cart_itemNo() != "" ) { ?>
					<? foreach( $ro4->charges_cart_itemNo() as $itemNo ) { ?>
						$("#deleteBtn<? echo $itemNo ?>").click(function() {

							var inventoryLocation = '<? echo $inventoryLocation ?>';
							var batchNo = '<? echo $batchNo ?>';
							var registrationNo = '<? echo $registrationNo ?>';	
							
							var data = {
								inventoryLocation:inventoryLocation,
								batchNo:batchNo,
								registrationNo:registrationNo
							};												

							$.post('dept-charges-remove.php',{itemNo:'<? echo $itemNo ?>'},function(result){
								open('POST','dept-charges.php',data,'_self');
								console.log(result);
							});
						});
					<? } ?>
				<? } ?>

				$("#chargesCart").click(function() {

					var redirect_room = '<? echo $ro->selectNow('registrationDetails','room','registrationNo',$registrationNo) ?>';
					var redirect_username = '<? echo $ro->selectNow('registeredUser','username','employeeID',$_SESSION["employeeID"]) ?>';
					var redirect_batchNo = '<? echo $batchNo ?>';
					var redirect_registrationNo = '<? echo $registrationNo ?>';

					var data = {
						room:redirect_room,
						username:redirect_username,
						batchNo:redirect_batchNo,
						registrationNo:redirect_registrationNo
					};

					open('GET','../patientProfile/ECART/cartHandler.php',data,'_self');					

				});

				$("#pharmacy").click(function(){

					var redirect_inventoryLocation = 'PHARMACY';
					var redirect_batchNo = '<? echo $batchNo ?>';
					var redirect_registrationNo = '<? echo $registrationNo ?>';

					var data = {
						inventoryLocation:redirect_inventoryLocation,
						batchNo:redirect_batchNo,
						registrationNo:redirect_registrationNo
					};

					open('POST','dept-charges.php',data,'_self');
				});


				$("#nsStation").click(function(){

					var redirect_inventoryLocation = 'NURSING';
					var redirect_batchNo = '<? echo $batchNo ?>';
					var redirect_registrationNo = '<? echo $registrationNo ?>';

					var data = {
						inventoryLocation:redirect_inventoryLocation,
						batchNo:redirect_batchNo,
						registrationNo:redirect_registrationNo
					};

					open('POST','dept-charges.php',data,'_self');
				});

				$("#operatingRoom").click(function(){

					var redirect_inventoryLocation = 'OR';
					var redirect_batchNo = '<? echo $batchNo ?>';
					var redirect_registrationNo = '<? echo $registrationNo ?>';

					var data = {
						inventoryLocation:redirect_inventoryLocation,
						batchNo:redirect_batchNo,
						registrationNo:redirect_registrationNo
					};

					open('POST','dept-charges.php',data,'_self');

				});

				$("#emergencyRoom").click(function(){

					var redirect_inventoryLocation = 'E.R';
					var redirect_batchNo = '<? echo $batchNo ?>';
					var redirect_registrationNo = '<? echo $registrationNo ?>';

					var data = {
						inventoryLocation:redirect_inventoryLocation,
						batchNo:redirect_batchNo,
						registrationNo:redirect_registrationNo
					};

					open('POST','dept-charges.php',data,'_self');

				});

			});
		</script>

	</head>
	<body>
		<div class="container">
			<br>
			<div class="btn-group" role="group">
				<button id="chargesCart" class="btn btn-default">
					<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					 Charges Cart
				</button>
				<button id="pharmacy"  class="<? echo $pharmacyClass ?>">
					<i class="fa fa-hospital-o" aria-hidden="true"></i>
					 Pharmacy
				</button>
				<button id="nsStation" class="<? echo $nursingClass ?>">
					<i class="fa fa-medkit" aria-hidden="true"></i>
					 NS Station
				</button>
				<button id="operatingRoom" class="<? echo $orClass ?>">
					<i class="fa fa-heartbeat" aria-hidden="true"></i>
					 Oper. Room
				</button>
				<button id="emergencyRoom" class="<? echo $erClass ?>">
					<i class="fa fa-ambulance" aria-hidden="true"></i>
					 Emerg. Room
				</button>
			</div>
			<br><br>
			<div class="row">
				<div class="col-md-5">
					<div class="input-group">
						<input type="text" id="searchBox" class="form-control" placeholder="Search Inventory to Request" autocomplete="off">
						<span class="input-group-btn">
							<button id="searchInventory" class="btn btn-info">Search Inventory</button>
						</span>
					</div>				
				</div>
			</div>
			<div class="row">
				<div id="result" class="col-md-7">
					
				</div>
				<div class="col-md-5">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h4 class="panel-title">Charges</h4>
						</div>
						<div class="panel-body">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Particulars</th>
										<th>QTY</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<? if( $ro4->charges_cart_itemNo() != "" ) { ?>
										<? foreach( $ro4->charges_cart_itemNo() as $itemNo ) { ?>
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
													<button id="deleteBtn<? echo $itemNo ?>" class="btn btn-danger btn-sm">
														Remove
													</button>
												</td>
											</tr>
										<? } ?>
									<? } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
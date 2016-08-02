<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$requesitionNo = $_GET['requesitionNo'];

	$ro = new database();
	$ro4 = new database4();

	 $ro4->requested_inventory($requesitionNo); 

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<script src="../js/open.js"></script>
		<script src="../js/jquery.jstepper.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script src="../../bootstrap-3.3.6/js/bootstrap.js"></script>
		<script>
			
			$(document).ready(function(){

				$("#searchInventory").click(function(){
					
					var searchBox = $("#searchBox").val();
					var requesitionNo = <? echo $requesitionNo ?>;

					var data = {
						searchValue:searchBox,
						requesitionNo:requesitionNo
					};
					$.post("search-inventory.php",data,function(result){
						$("#content").html(result);
					});
				});


				$("#searchBox").keypress(function(event){
					if(event.which == 13) {
						var searchBox = $("#searchBox").val();
						var requesitionNo = <? echo $requesitionNo ?>;

						var data = {
							searchValue:searchBox,
							requesitionNo:requesitionNo
						};
						$.post("search-inventory.php",data,function(result){
							$("#content").html(result);
						});						
					}
				});

				$("#confirmBtn").click(function(){
					open("get","confirm-requesition.html",{},"_self");
				});

				<? if( $ro4->requested_inventory_verificationNo() != "" ) { ?>
					<? foreach( $ro4->requested_inventory_verificationNo() as $verificationNo ) { ?>	

						$("#removeBtn<? echo $verificationNo ?>").click(function() {
							$.post("delete-request.php",{verificationNo:<? echo $verificationNo ?>},function(){
								location.reload();
							});
					
						});
					
					<? } ?>
				<? } ?>

			});

		</script>
	</head>
	<body>
		<div class="container">
			<h5>&nbsp;</h5>
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
				<div id="content" class="col-md-6">
					<!--pra s content-->
				</div>
				<div id="requestCart" class="col-md-6">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h4 class="panel-title">Requested Inventory</h4>
						</div>
						<div class="panel-body">
							<table id="requestedInventory" class="table table-hover">
								<thead>
									<tr>
										<th>Particulars</th>
										<th>QTY</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<? if( $ro4->requested_inventory_verificationNo() != "" ) { ?>
										<? foreach( $ro4->requested_inventory_verificationNo() as $verificationNo ) { ?>
											<tr>
												<? if( $ro->selectNow("inventoryManager","inventoryType","verificationNo",$verificationNo) == "medicine" ) { ?>
													<td>
														<? 
															echo $ro->selectNow("inventoryManager","genericName","verificationNo",$verificationNo) 
														?>
														<h6>
															<? 
																echo $ro->selectNow("inventoryManager","description","verificationNo",$verificationNo) 
															?>
														</h6>
													</td>
												<? }else { ?>
													<td>
														<?
															echo $ro->selectNow("inventoryManager","description","verificationNo",$verificationNo)
														?>
													</td>
												<? } ?>
												<td>
													<? echo $ro->selectNow("inventoryManager","quantity","verificationNo",$verificationNo) ?>
												</td>
												<td>
													<input type="button" id="removeBtn<? echo $verificationNo ?>" class="btn btn-danger" value="Remove">
												</td>
											</tr>
										<? } ?>
									<? }else { } ?>
								</tbody>
							</table>
							<div class="col-md-12 text-right">
								<button id="checkoutBtn" class="btn btn-success" data-toggle="modal" data-target="#checkoutModal">
									<i class="glyphicon glyphicon-shopping-cart"></i>
									&nbsp;
									Checkout
								</button>
							</div>
							<div id="checkoutModal" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Requesition</h4>
										</div>
										<div class="modal-body">
											<p> Confirm Checkout? </p>
										</div>
										<div class="modal-footer">
											<button class="btn btn-danger" data-dismiss="modal">Cancel</button>
											<button id="confirmBtn" class="btn btn-success">Confirm</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
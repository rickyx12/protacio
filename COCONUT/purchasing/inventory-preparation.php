<?

	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$ro = new database();
	$ro4 = new database4();

	$ro4->list_inventory_preparation();

?>
<!DOCTYPE html>
<html>
	<head>
	  <meta charset="UTF-8">
	  <title></title>
	  <script src="../js/jquery-2.1.4.min.js"></script>
	  <script src="../../bootstrap-3.3.6/js/bootstrap.js"></script>
	  <script src="../js/sweetalert/dist/sweetalert.min.js"></script>
	  <link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
	  <link rel="stylesheet" href="../js/sweetalert/dist/sweetalert.css"></link>
	  <script>
	  	
	 	$(document).ready(function(){

	 		$("#addNow").click(function(){

	 			var newPreparation = $("#newPreparation").val();

	 			$.post("inventory-preparation-add.php",{ preparation:newPreparation },function(result){
	 				//console.log(result);
	 				$("#newPreparation").val("");
	 				swal({
	 					title:'Congrats!',
	 					text:'Inventory Preparation has been added',
	 					type:'success'
	 				},
	 				function(){
	 					location.reload();
	 				});
	 			});

	 		});

	 		<? foreach( $ro4->list_inventory_preparation_preparationNo() as $preparationNo ) { ?>
	 			
	 			$("#removeBtn<? echo $preparationNo ?>").click(function(){
	 				$.post("inventory-preparation-remove.php",{preparationNo:'<? echo $preparationNo ?>'},function(){
	 					swal({
	 						title:'Wow!',
	 						text:'Inventory Preparation has been Deleted',
	 						type:'error'
	 					},
	 					function(){
	 						location.reload();
	 					});
	 				});
	 			});

	 			$("#updateBtn<? echo $preparationNo ?>").click(function(){

	 				var newPreparation = $("#newPreparation<? echo $preparationNo ?>").val();

	 				var data = {
	 					preparationNo:'<? echo $preparationNo ?>',
	 					newPreparation:newPreparation
	 				};

	 				$.post("inventory-preparation-update.php",data,function(){
	 					swal({
	 						title:'Amazing!',
	 						text:'Inventory Preparation has been changed',
	 						type:'success'
	 					},
	 					function(){
	 						location.reload();
	 					});
	 				});
	 			});

	 		<? } ?>


	 	});

	  </script>
	</head>
	<body>
		<div class="container">
			<h1>Inventory Preparation</h1>
			<div class="row">
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#addPreparation">
					<i class="glyphicon glyphicon-plus"></i>
					Add New Preparation
				</button>
				<div id="addPreparation" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">New Preparation</h4>
							</div>
							<div class="modal-body">
								<input id="newPreparation" type="text" class="form-control">
							</div>
							<div class="modal-footer">
								<button class="btn btn-danger" data-dismiss="modal">
									Cancel
								</button>
								<button  id="addNow" class="btn btn-success" data-dismiss="modal">
									Add Preparation
								</button>
							</div>
						</div>
					</div>	
				</div>
			</div>
			<div class="row">
				<div class="col-md-7">
					<table class="table table-hover">
						<thead>
							<th>Preparation</th>
							<th></th>
						</thead>
						<tbody>
							<? foreach( $ro4->list_inventory_preparation_preparationNo() as $preparationNo ) { ?>
								<tr>
									<td>
										<?
											echo $ro->selectNow("inventoryPreparation","preparation","preparationNo",$preparationNo)
										?>
									</td>
									<td>
										<button type="button" class="btn btn-success" data-toggle="modal" data-target="#update<? echo $preparationNo ?>">
											Update
										</button>
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#remove<? echo $preparationNo ?>">
											Remove
										</button>
									</td>
								</tr>
								<div id="update<? echo $preparationNo ?>" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">Update Preparation</h4>
											</div>
											<div class="modal-body">
												<input id="newPreparation<? echo $preparationNo ?>" type="text" class="form-control" value="<? echo $ro->selectNow('inventoryPreparation','preparation','preparationNo',$preparationNo) ?>" autocomplete="off" >
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-danger" data-dismiss="modal">
													Cancel
												</button>
												<button id="updateBtn<? echo $preparationNo ?>" type="button" class="btn btn-success" data-dismiss="modal">
													Update
												</button>
											</div>
										</div>
									</div>
								</div>
								<div id="remove<? echo $preparationNo ?>" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">Remove Preparation</h4>
											</div>
											<div class="modal-body">
												Remove <b><? echo $ro->selectNow("inventoryPreparation","preparation","preparationNo",$preparationNo) ?></b> ?
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-danger" data-dismiss="modal">
													Cancel
												</button>
												<button id="removeBtn<? echo $preparationNo ?>" type="button" class="btn btn-success" data-dismiss="modal">
													Remove
												</button>
											</div>
										</div>
									</div>
								</div>
							<? } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>
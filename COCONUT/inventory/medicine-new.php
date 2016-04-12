<?php include "../../myDatabase4.php"; ?>
<?php include "../../myDatabase.php" ?>
<?php session_start() ?>
<?php $ro = new database4() ?>
<?php $ro1 = new database() ?>
<?php $ro->inventory_list("medicine") ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../../jquery-2.1.4.min.js"></script>
	<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
	<script src="../../bootstrap-3.3.6/js/bootstrap.js"></script>

	<script>
		$(document).ready(function(){

			<?php foreach($ro->inventory_list_inventoryCode() as $inventoryCode) { ?>

				$(document).on("click","#deleteNow<?php echo $inventoryCode ?>",function(){ 
					$.post("medicine-new-delete.php",{inventoryCode:<?php echo $inventoryCode ?>},function(data){
						$("#myTable").load("inventory-new.php #myTable");	
					});
				});


				$(document).on("click","#updateNow<?php echo $inventoryCode ?>",function(){

					var description = $("#description<?php echo $inventoryCode ?>").val();
					var generic = $("#generic<?php echo $inventoryCode ?>").val();
					var quantity = $("#quantity<?php echo $inventoryCode ?>").val();
					var unitcost = $("#unitcost<?php echo $inventoryCode ?>").val();
					var ipdPrice = $("#ipdPrice<?php echo $inventoryCode ?>").val();
					var opdPrice = $("#opdPrice<?php echo $inventoryCode ?>").val();

					var myData = {
						inventoryCode:<?php echo $inventoryCode ?>,
						description:description,
						generic:generic,
						quantity:quantity,
						unitcost:unitcost,
						ipdPrice:ipdPrice,
						opdPrice:opdPrice
					}

					$.post("medicine-new-update.php",myData,function(data) {
						$("#myTable").load("inventory-new.php #myTable");
					})
				})

			<?php } ?>

		});

	</script>
</head>
<body>
	<div class="container">

		
		<div class="col-md-3">
			<h3>Medicine</h3>
		</div>
		<table id="myTable" class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Stock#</th>
					<th>Brand</th>
					<th>Generic</th>
					<th>QTY</th>
					<th>Unitcost</th>
					<th>Inpatient</th>
					<th>Outpatient</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($ro->inventory_list_inventoryCode() as $inventoryCode) { ?>
				<tr>
					<td>&nbsp;<?php echo $inventoryCode ?></td>
					<td>&nbsp;<?php echo $ro1->selectNow("inventory","stockCardNo","inventoryCode",$inventoryCode) ?></td>
					<td>&nbsp;<?php echo $ro1->selectNow("inventory","description","inventoryCode",$inventoryCode) ?></td>
					<td>&nbsp;<?php echo $ro1->selectNow("inventory","genericName","inventoryCode",$inventoryCode) ?></td>
					<td>&nbsp;<?php echo $ro1->selectNow("inventory","quantity","inventoryCode",$inventoryCode) ?></td>
					<td>&nbsp;<?php echo $ro->number_format($ro1->selectNow("inventory","unitcost","inventoryCode",$inventoryCode)) ?></td>
					<td>&nbsp;<?php echo $ro->number_format($ro1->selectNow("inventory","ipdPrice","inventoryCode",$inventoryCode)) ?></td>
					<td>&nbsp;<?php echo $ro->number_format($ro1->selectNow("inventory","opdPrice","inventoryCode",$inventoryCode)) ?></td>
					<td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateModal<?php echo $inventoryCode ?>">Update</button></td>
					<td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#removeModal<?php echo $inventoryCode ?>">Remove</button></td>					
				</tr>
			<?php } ?>
			</tbody>
		</table>

		<?php foreach($ro->inventory_list_inventoryCode() as $inventoryCode) { ?>
		<div id="removeModal<?php echo $inventoryCode ?>" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Header</h4>
					</div>
					<div class="modal-body">
						<p>DELETE <b><?php echo $ro1->selectNow("inventory","description","inventoryCode",$inventoryCode) ?></b>?</p>
					</div>
					<div class="modal-footer">
						 <button type="button" class="btn btn-success" data-dismiss="modal">Cancel Remove</button>
						  <button id="deleteNow<?php echo $inventoryCode ?>" type="button" class="btn btn-danger" data-dismiss="modal">Confirm Remove</button>
					</div>
				</div>
			</div>
		</div>



		<div id="updateModal<?php echo $inventoryCode ?>" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><?php echo $ro1->selectNow('inventory','description','inventoryCode',$inventoryCode) ?></h4>
					</div>
					<div class="modal-body">
						<div class="container">
						<div class="col-md-4">
							<div class="form-group">
								<label>Brand</label>
								<input type="text" id="description<?php echo $inventoryCode ?>" class="form-control" value="<?php echo $ro1->selectNow('inventory','description','inventoryCode',$inventoryCode) ?>">
							</div>
							<div class="form-group">
								<label>Generic</label>
								<input type="text" id="generic<?php echo $inventoryCode ?>" class="form-control" value="<?php echo $ro1->selectNow('inventory','genericName','inventoryCode',$inventoryCode) ?>">
							</div>
							<div class="form-group">
								<label>Quantity</label>
								<input type="text" id="quantity<?php echo $inventoryCode ?>" class="form-control" value="<?php echo $ro1->selectNow('inventory','quantity','inventoryCode',$inventoryCode) ?>">
							</div>
							<div class="form-group">
								<label>Unitcost</label>
								<input type="text" id="unitcost<?php echo $inventoryCode ?>" class="form-control" value="<?php echo $ro1->selectNow('inventory','unitcost','inventoryCode',$inventoryCode) ?>">
							</div>
							<div class="form-group">
								<label>Inpatient Price</label>
								<input type="text" id="ipdPrice<?php echo $inventoryCode ?>" class="form-control" value="<?php echo $ro1->selectNow('inventory','ipdPrice','inventoryCode',$inventoryCode) ?>">
							</div>
							<div class="form-group">
								<label>Outpatient Price</label>
								<input type="text" id="opdPrice<?php echo $inventoryCode ?>" class="form-control" value="<?php echo $ro1->selectNow('inventory','opdPrice','inventoryCode',$inventoryCode) ?>">
							</div>
						</div>
						</div>
					</div>
					<div class="modal-footer">
						 <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
						  <button id="updateNow<?php echo $inventoryCode ?>" type="button" class="btn btn-danger" data-dismiss="modal">Update</button>
					</div>
				</div>
			</div>
		</div>

		<?php } ?>

	</div>

</body>
</html>
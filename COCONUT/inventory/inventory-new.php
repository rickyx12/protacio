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
					$.post("inventory-new-delete.php",{inventoryCode:<?php echo $inventoryCode ?>},function(data){
						$("#myTable").load("inventory-new.php #myTable");	
					});
				});

			<?php } ?>

		});

	</script>
</head>
<body>
	<div class="container">
		<h1>Hello</h1>
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
		<?php } ?>

	</div>

</body>
</html>
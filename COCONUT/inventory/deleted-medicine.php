<? include "../../myDatabase.php" ?>
<? include "../../myDatabase4.php" ?>
<? $ro = new database() ?>
<? $ro4 = new database4() ?>
<? //$ro4->deleted_inventory ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../../jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script src="../../bootstrap-3.3.6/js/bootstrap.js"></script>

		<script>
			$(document).on("keypress","#search",function(event){

				var search = $("#search").val();

				if( event.which == 13 ){

						
						$.getJSON("deleted-medicine-search.php",{search:search},function(result){
							var html = "";
							$.each(result,function(index,field){
								console.log(field.inventoryCode);
								html += "<tr>";
								html += "<td>&nbsp;"+field.inventoryCode+"</td>";
								html += "<td>&nbsp;"+field.stockCardNo+"</td>";
								html += "<td>&nbsp;"+field.genericName+"</td>";
								html += "<td>&nbsp;"+field.description+"</td>";
								html += "<td>&nbsp;"+field.unitcost+"</td>"
								html += "<td>&nbsp;"+field.ipdPrice+"</td>";
								html += "<td>&nbsp;"+field.opdPrice+"</td>";
								html += "<td>&nbsp;"+field.status+"</td>"
							});
							$("#search").val("");
							$("#deletedInventory").html(html);
						});						

									
				}


			})
		</script>

	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<h3>Deleted Medicine</h3>
					<div class="form-group">
						<input type="text" id="search" class="form-control" autocomplete="off" placeholder="Search Deleted Medicine">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Stock#</th>
								<th>Generic Name</th>
								<th>Brand Name</th>
								<th>Unitcost</th>
								<th>IPD</th>
								<th>OPD</th>
								<th>Deleted</th>
							</tr>
						</thead>
						<tbody id="deletedInventory">
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>	
								<td>&nbsp;</td>							
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>
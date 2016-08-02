<? include "../../myDatabase.php" ?>

<?
	$stockCardNo = $_POST['stockCardNo'];
	$invoiceNo = $_POST['invoiceNo'];
	$siNo = $_POST['siNo'];
?>

<? $ro = new database() ?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Supplies</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../js/jquery-2.1.4.min.js"></script>
	<script src="../js/jquery-ui.min.js"></script>
	<script src="../js/jquery.tooltipster.min.js"></script>
	<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
	<script src="../../bootstrap-3.3.6/js/bootstrap.js"></script>	
	<link rel="stylesheet" href="../js/jquery-ui.css"></link>
	<link rel="stylesheet" href="../js/jquery-ui.theme.min.css"></link> 
	<link rel="stylesheet" href="../myCSS/tooltipster.css"></link> 
	<link rel="stylesheet" href="../myCSS/tooltipster-noir.css"></link>

	<script>
		$(document).ready(function(){

			$("#ui-datepicker-div").remove();
			$("#expiration").datepicker({
				dateFormat:'yy-mm-dd',
			});


			$("#unitcost").tooltipster({
				content: $('<span>Loading....</span>'),
				position: 'right',
				theme: 'tooltipster-noir',
				trigger:'click',
				contentAsHTML:true,
				functionBefore:function(origin,continueTooltip) {
					continueTooltip();
					if( origin.data('ajax') !== 'cached' ){ 
						$.ajax({
							type:'POST',
							url:'../inventory/addSupplies_unitcost.php',
							data:{'stockCardNo':'<? echo $stockCardNo ?>'},
							success:function(data) {
								origin.tooltipster('content',data).data('ajax','cached');
							}
						});
					}
				}
			});


			$("#price").tooltipster({
				content: $('<span>Loading....</span>'),
				position: 'right',
				theme: 'tooltipster-noir',
				trigger:'click',
				contentAsHTML:true,
				functionBefore:function(origin,continueTooltip) {
					continueTooltip();
					if( origin.data('ajax') !== 'cached' ){ 
						$.ajax({
							type:'POST',
							url:'../inventory/addSupplies_price.php',
							data:{'stockCardNo':'<? echo $stockCardNo ?>'},
							success:function(data) {
								origin.tooltipster('content',data).data('ajax','cached');
							}
						});
					}
				}
			});

	
			$("#addBtn").click(function(){
				var stockCardNo = $("#stockCardNo").val();
				var siNo = $("#siNo").val();
				var description = $("#description").val();
				var quantity = $("#quantity").val();
				var freeGoods = $("#freeGoods").val();
				var unitcost = $("#unitcost").val();
				var price = $("#price").val();
				var expiration = $("#expiration").val();
				var dateAdded = $("#dateAdded").val();
				var inventoryLocation = $("#inventoryLocation").val();
				var criticalLevel = $("#criticalLevel").val();
				var supplier = $("#supplier").val();
				var invoiceNo = $("#invoiceNo").val();
				var remarks = $("#remarks").val();
				var classification = $('input[name=classification]:checked').val();
				var lock = $('input[name=lock]:checked').val();

				var data = {
					"stockCardNo":stockCardNo,
					"siNo":siNo,
					"description":description,
					"quantity":quantity,
					"freeGoods":freeGoods,
					"unitcost":unitcost,
					"price":price,
					"expiration":expiration,
					"dateAdded":dateAdded,
					"inventoryLocation":inventoryLocation,
					"criticalLevel":criticalLevel,
					"supplier":supplier,
					"invoiceNo":invoiceNo,
					"remarks":remarks,
					"classification":classification,
					"lock":lock
				};

				$.post("addSupplies1.php",data,function(result){
					$("#invoiceItems").load("view-invoice-items.php",{ siNo:<? echo $siNo ?> });
				});

			});


		});
	</script>
</head>
<body>
	<div class="container">
		<div class="col-md-6">
			<h3></h3>
				<div class="panel panel-info">
					<div class="panel-heading">
						Entry for New Supplies
					</div>
					<div class="panel-body">
						<form class="form-horizontal" method="post" action="addSupplies1.php" role="form">
							<input type="hidden" id="stockCardNo" value="<? echo $stockCardNo ?>">
							<input type="hidden" id="siNo" value="<? echo $siNo ?>">
							<div class="form-group">
								<label class="control-label col-sm-2">Description</label>
								<div class="col-sm-10">
									<input type="text" id="description" name="description" class="form-control col-sm-10" autocomplete value="<? echo $ro->selectNow('inventoryStockCard','description','stockCardNo',$stockCardNo) ?>">
								</div>
							</div>


							<div class="form-group">
								<label class="form-label col-sm-2">Quantity</label>
								<div class="col-sm-5">
									<input type="text" id="quantity" name="quantity" class="form-control col-sm-5" autocomplete="off" placeholder="pcs without Free Goods" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Free</label>
								<div class="col-sm-5">
									<input type="text" id="freeGoods" class="form-control col-sm-5" autocomplete="off" placeholder="Free Goods QTY">
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Unitcost</label>
								<div class="col-sm-5">
									<input type="text" id="unitcost" name="unitcost" tabindex="-1" class="form-control col-sm-5" placeholder="unitcost per pcs" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Price</label>
								<div class="col-sm-5">
									<input type="text" id="price" name="sellingPrice" tabindex="-1" class="form-control col-sm-5" placeholder="Selling Price" autocomplete="off">
								</div>
							</div>


							<div class="form-group">
								<label class="form-label col-sm-2">Expiration</label>
								<div class="col-sm-5">
									<input type="text" id="expiration" name="expiration" class="form-control col-sm-5" readonly="readonly" placeholder="Click to Enter Date">
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Added</label>
								<div class="col-sm-5">
									<input type="text" id="dateAdded" name="dateAdded" class="form-control col-sm-5" value="<? echo date('Y-m-d') ?>" readonly="readonly">
								</div>
							</div>

							<div class="form-group"> 
								<label class="form-label col-sm-2">Location</label>
								<div class="col-sm-10">
									<input type="radio" id="inventoryLocation" name="inventoryLocation" value="Stockroom" checked> Stockroom
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Crit. Lvl</label>
								<div class="col-sm-5">
									<input id="criticalLevel" name="criticalLevel" type="text" class="form-control col-sm-5" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Supplier</label>
								<div class="col-sm-10">
									<input type="text" id="supplier" class="form-control col-sm-10" readonly value="<? echo $ro->selectNow('salesInvoice','supplier','siNo',$siNo) ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Invoice#</label>
								<div class="col-sm-5">
									<input id="invoiceNo" name="invoiceNo" type="text" class="form-control col-sm-5" autocomplete="off" readonly value="<? echo $invoiceNo ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Remarks</label>
								<div class="col-sm-10">
									<input id="remarks" name="remarks" type="text" class="form-control col-sm-10" autocomplete="off">
								</div>
							</div>

							<div class="form-group"> 
								<label class="form-label col-sm-2">Class</label>
								<div class="col-sm-10">
									<input type="radio" name="classification" value="inventory" checked="checked"> Inventory
									&nbsp;&nbsp;
									<input type="radio" name="classification" value="noInventory"> No Inventory
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Lock</label>
								<div class="col-sm-5">
									<input type="radio" name="lock" value="yes">Yes
									&nbsp;&nbsp;
									<input type="radio" name="lock" value="no" checked>No
								</div>
							</div>


							<div class="form-group">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
									<input type="button" id="addBtn" class="btn btn-success center" value="Add Supplies">
								</div>
								<div class="col-sm-4"></div>
							</div>
						</form>
					</div>
				</div>
		</div>
	</div>
</body>
</html>
<? require_once "../authentication.php" ?>
<? include "../../myDatabase.php" ?>

<?
	$invoiceNo = $_POST['invoiceNo'];
	$stockCardNo = $_POST['stockCardNo'];
	$siNo = $_POST['siNo'];
?>

<? $ro = new database() ?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Medicine</title>
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
					dateFormat:'yy-mm-dd'
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
							url:'../inventory/addMedicine_unitcost.php',
							data:{'stockCardNo':'<? echo $stockCardNo ?>'},
							success:function(data) {
								origin.tooltipster('content',data).data('ajax','cached');
							}
						});
					}
				}
			});


			$("#opdPrice").tooltipster({
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
							url:'../inventory/addMedicine_opdPrice.php',
							data:{'stockCardNo':'<? echo $stockCardNo ?>'},
							success:function(data) {
								origin.tooltipster('content',data).data('ajax','cached');
							}
						});
					}
				}
			});


			$("#ipdPrice").tooltipster({
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
							url:'../inventory/addMedicine_ipdPrice.php',
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
				var brandName = $("#brandName").val();
				var genericName = $("#genericName").val();
				var preparation = $("#preparation").val();
				var quantity = $("#quantity").val();
				var freeGoods = $("#freeGoods").val();
				var unitcost = $("#unitcost").val();
				var opdPrice = $("#opdPrice").val();
				var ipdPrice = $("#ipdPrice").val();
				var expiration = $("#expiration").val();
				var dateAdded = $("#dateAdded").val();
				var inventoryLocation = $("#inventoryLocation").val();
				var criticalLevel = $("#criticalLevel").val();
				var supplier = $("#supplier").val();
				var invoiceNo = $("#invoiceNo").val();
				var remarks = $("#remarks").val();
				var lock = $('input[name=lock]:checked').val();

				var data = {
					"stockCardNo":stockCardNo,
					"siNo":siNo,
					"brandName":brandName,
					"genericName":genericName,
					"preparation":preparation,
					"quantity":quantity,
					"freeGoods":freeGoods,
					"unitcost":unitcost,
					"opdPrice":opdPrice,
					"ipdPrice":ipdPrice,
					"expiration":expiration,
					"dateAdded":dateAdded,
					"inventoryLocation":inventoryLocation,
					"criticalLevel":criticalLevel,
					"supplier":supplier,
					"invoiceNo":invoiceNo,
					"remarks":remarks,
					"lock":lock	
				}

				$.post("addMedicine1.php",data,function(result){
					//console.log(result);
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
						Entry for New Medicine
					</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form">
							<input type="hidden" id="stockCardNo" name="stockCardNo" value="<? echo $stockCardNo ?>">
							<input type="hidden" id="siNo" name="siNo" value="<? echo $siNo ?>">
							<div class="form-group">
								<label class="control-label col-sm-2">Brand</label>
								<div class="col-sm-10">
									<input type="text" id="brandName" name="brandName" class="form-control col-sm-10" value="<? echo $ro->selectNow('inventoryStockCard','description','stockCardNo',$stockCardNo) ?>" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-2">Generic</label>
								<div class="col-sm-10">
									<input type="text" id="genericName" name="genericName" class="form-control col-sm-10" value="<? echo $ro->selectNow('inventoryStockCard','genericName','stockCardNo',$stockCardNo) ?>" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-2">Preparation</label>
								<div class="col-sm-7">
									<select id="preparation" name="preparation" class="col-sm-7 form-control">
										<option></option>
										<? $ro->showOption("inventoryPreparation","preparation") ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Quantity</label>
								<div class="col-sm-5">
									<input type="text" id="quantity" name="quantity" class="form-control col-sm-5" autocomplete="off" placeholder="pcs without free goods">
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Free</label>
								<div class="col-sm-5">
									<input type="text" id="freeGoods" class="form-control" autocomplete="off" placeholder="Free Goods QTY">
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Unitcost</label>
								<div class="col-sm-5">
									<input type="text" id="unitcost" name="unitcost" id="unitcost" tabindex="-1" class="form-control col-sm-5" placeholder="unitcost per pcs" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Outpatient</label>
								<div class="col-sm-5">
									<input type="text" id="opdPrice" name="opdPrice" tabindex="-1" class="form-control col-sm-5" placeholder="Price for Outpatient" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Inpatient</label>
								<div class="col-sm-5">
									<input type="text" id="ipdPrice" name="ipdPrice" tabindex="-1" class="form-control col-sm-5" placeholder="Price for Inpatient" autocomplete="off">
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
									<input type="text" id="dateAdded" name="dateAdded" id="dateAdded" class="form-control col-sm-5" value="<? echo date('Y-m-d') ?>" readonly="readonly">
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
									<input type="text" id="supplier" name="supplier" class="form-control col-sm-5" value="<? echo $ro->selectNow('salesInvoice','supplier','siNo',$siNo) ?>" readonly>
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Invoice#</label>
								<div class="col-sm-5">
									<input id="invoiceNo" name="invoiceNo" type="text" value="<? echo $invoiceNo ?>" class="form-control col-sm-5" autocomplete="off" readonly>
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Remarks</label>
								<div class="col-sm-10">
									<input id="remarks" name="remarks" type="text" class="form-control col-sm-10" autocomplete="off">
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
									<input type="button" id="addBtn" class="btn btn-success center" value="Add Medicine">
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
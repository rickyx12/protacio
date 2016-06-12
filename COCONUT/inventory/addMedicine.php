<? include "../../myDatabase.php" ?>

<?
$username = $_GET['username'];
$status = $_GET['status'];
$stockCardNo = $_GET['stockCardNo'];
$description = $_GET['description'];
$genericName = $_GET['genericName'];
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
							url:'addMedicine_unitcost.php',
							data:{'stockCardNo':'<? echo $stockCardNo ?>'},
							success:function(data) {
								origin.tooltipster('content',data).data('ajax','cached');
							}
						});
					}
				}
			});


			$("#outpatient").tooltipster({
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
							url:'addMedicine_opdPrice.php',
							data:{'stockCardNo':'<? echo $stockCardNo ?>'},
							success:function(data) {
								origin.tooltipster('content',data).data('ajax','cached');
							}
						});
					}
				}
			});


			$("#inpatient").tooltipster({
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
							url:'addMedicine_ipdPrice.php',
							data:{'stockCardNo':'<? echo $stockCardNo ?>'},
							success:function(data) {
								origin.tooltipster('content',data).data('ajax','cached');
							}
						});
					}
				}
			});			





		});
	</script>
</head>
<body>
	<div class="container">
		<div class="col-md-3">
			
		</div>
		<div class="col-md-6">
			<h3></h3>
				<div class="panel panel-info">
					<div class="panel-heading">
						Entry for New Medicine
					</div>
					<div class="panel-body">
						<form class="form-horizontal" method="post" action="addMedicine1.php" role="form">
							<input type="hidden" name="username" value="<? echo $username ?>">
							<input type="hidden" name="stockCardNo" value="<? echo $stockCardNo ?>">
							<div class="form-group">
								<label class="control-label col-sm-2">Brand</label>
								<div class="col-sm-10">
									<input type="text" name="brandName" class="form-control col-sm-10" value="<? echo $description ?>" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-2">Generic</label>
								<div class="col-sm-10">
									<input type="text" name="genericName" class="form-control col-sm-10" value="<? echo $genericName ?>" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-2">Preparation</label>
								<div class="col-sm-7">
									<select name="preparation" class="col-sm-7 form-control">
										<option></option>
										<? $ro->showOption("inventoryPreparation","preparation") ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Quantity</label>
								<div class="col-sm-5">
									<input type="text" name="quantity" class="form-control col-sm-5" autocomplete="off" placeholder="pcs" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Unitcost</label>
								<div class="col-sm-5">
									<input type="text" name="unitcost" id="unitcost" tabindex="-1" class="form-control col-sm-5" placeholder="unitcost per pcs" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Outpatient</label>
								<div class="col-sm-5">
									<input type="text" name="opdPrice" id="outpatient" tabindex="-1" class="form-control col-sm-5" placeholder="Price for Outpatient" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Inpatient</label>
								<div class="col-sm-5">
									<input type="text" name="ipdPrice" id="inpatient" tabindex="-1" class="form-control col-sm-5" placeholder="Price for Inpatient" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Expiration</label>
								<div class="col-sm-5">
									<input type="text" name="expiration" id="expiration" class="form-control col-sm-5" readonly="readonly" placeholder="Click to Enter Date">
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Added</label>
								<div class="col-sm-5">
									<input type="text" name="dateAdded" id="dateAdded" class="form-control col-sm-5" value="<? echo date('Y-m-d') ?>" readonly="readonly">
								</div>
							</div>

							<div class="form-group"> 
								<label class="form-label col-sm-2">Location</label>
								<div class="col-sm-10">
									<input type="radio" name="inventoryLocation" value="PHARMACY" checked> Pharmacy
									&nbsp;&nbsp;
									<input type="radio" name="inventoryLocation" value="ER"> ER
									&nbsp;&nbsp;
									<input type="radio" name="inventoryLocation" value="OR"> OR
									&nbsp;&nbsp;
									<input type="radio" name="inventoryLocation" value="NS STATION"> NS Station
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Crit. Lvl</label>
								<div class="col-sm-5">
									<input name="criticalLevel" type="text" class="form-control col-sm-5" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Supplier</label>
								<div class="col-sm-10">
									<select name="supplier" class="form-control col-sm-10">
										<option></option>
										<? $ro->showOption("supplier","supplierName") ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Invoice#</label>
								<div class="col-sm-5">
									<input name="invoiceNo" type="text" class="form-control col-sm-5" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<label class="form-label col-sm-2">Remarks</label>
								<div class="col-sm-10">
									<input name="remarks" type="text" class="form-control col-sm-10" autocomplete="off">
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
									<input type="submit" class="btn btn-success center" value="Add Medicine">
								</div>
								<div class="col-sm-4"></div>
							</div>
						</form>
					</div>
				</div>
		</div>
		<div class="col-md-3">
			
		</div>
	</div>
</body>
</html>
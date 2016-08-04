<? require_once "../authentication.php" ?>
<? include "../../myDatabase.php" ?>
<? $ro = new database() ?>
<? $stockCardNo = $_GET['stockCardNo'] ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../../jquery-2.1.4.min.js"></script>
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

			$("#quarterAlert").hide();

			$("#formButton").click(function(){

				if( $("input[name=quarter]:checked").length > 0 ) {
					$("#endingForm").submit();
				}else {
					$("#quarterAlert").show();
				}

			});

			$("#unitcostMedicine").tooltipster({
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


			$("#unitcostSupplies").tooltipster({
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
							url:'addSupplies_unitcost.php',
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
		<h3>&nbsp;</h3>
		<div class="col-md-3">
			
		</div>

		<div class="col-md-6">
			
			<div id="quarterAlert" class="alert alert-danger text-center">
				Pls Select Quarter
			</div>
			<br>
			<div class="panel panel-success">
				<div class="panel panel-heading">
					Manual Ending Inventory
				</div>
				<div class="panel panel-body">
					<form id="endingForm" class="form-horizontal" role="form" method="post" action="addEndingInventory_manual1.php">
						<div class="form-group">
							<label class="control-label col-sm-2">Stock#</label>
							<div class="col-sm-3">
								<input type="text" name="stockCardNo" class="form-control col-sm-3" autocomplete="off" readonly="readonly" value="<? echo $stockCardNo ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-2">Brand</label>
							<div class="col-sm-8">
								<input type="text" name="brandName" class="form-control col-sm-8" readonly="readonly" value="<? echo $ro->selectNow('inventoryStockCard','description','stockCardNo',$stockCardNo) ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-2">Generic</label>
							<div class="col-sm-8">
								<input type="text" name="genericName" class="form-control col-sm-8" readonly="readonly" value="<? echo $ro->selectNow('inventoryStockCard','genericName','stockCardNo',$stockCardNo) ?>">
							</div>
						</div>						

						<div class="form-group">
							<label class="control-label col-sm-2">Current QTY</label>
							<div class="col-sm-3">
								<input type="text" name="currentQTY" class="form-control col-sm-3" autocomplete="off">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-2">Ending QTY</label>
							<div class="col-sm-3">
								<input type="text" name="endingQTY" class="form-control col-sm-3" autocomplete="off">
							</div>
						</div>	

						<div class="form-group">
							<label class="control-label col-sm-2">Unitcost</label>
							<div class="col-sm-5">
								<? if( $ro->selectNow('inventoryStockCard','inventoryType','stockCardNo',$stockCardNo) == "medicine" ) { ?>
									<input type="text" id="unitcostMedicine" name="unitcost" class="form-control col-sm-5" autocomplete="off" placeholder="unitcost per pcs">
								<? }else { ?>
									<input type="text" id="unitcostSupplies" name="unitcost" class="form-control col-sm-5" autocomplete="off" placeholder="unitcost per pcs">
								<? } ?>
							</div>
						</div>					

						<div class="form-group"> 
							<label class="form-label col-sm-2">Location</label>
							<div class="col-sm-10">
								<input type="radio" name="inventoryLocation" value="PHARMACY" checked> Pharmacy
								&nbsp;&nbsp;
								<input type="radio" name="inventoryLocation" value="E.R"> E.R
								&nbsp;&nbsp;
								<input type="radio" name="inventoryLocation" value="OR"> OR
								&nbsp;&nbsp;
								<input type="radio" name="inventoryLocation" value="NURSING"> NS Station
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-sm-2">Date</label>
							<div class="col-sm-5">
								<input type="text" name="dateAdded" class="form-control col-sm-5" readonly="readonly" value="<? echo date('Y-m-d') ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-2">Quarter</label>
							<div class="col-sm-10">
								<input type="radio" name="quarter" value="1st">&nbsp;1st
								&nbsp;&nbsp;&nbsp;
								<input type="radio" name="quarter" value="2nd">&nbsp;2nd
								&nbsp;&nbsp;&nbsp;
								<input type="radio" name="quarter" value="3rd">&nbsp;3rd
								&nbsp;&nbsp;&nbsp;
								<input type="radio" name="quarter" value="4th">&nbsp;4th
							</div>
						</div>		
						<br>
						<div class="form-group">
							<div class="col-sm-10 text-center">
								<input type="button" id="formButton" class="btn btn-success" value="Proceed">
							</div>
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
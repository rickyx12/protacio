<?

	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$inventoryType = $_POST['inventoryType'];
	$quarter = $_POST['quarter'];

	$totalItems = 0;
	$grandTotalCost = 0;


	$ro = new database();
	$ro4 = new database4();

	$ro4->ending_inventory_list($quarter,$inventoryType)

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<script src="../js/jquery.tooltipster.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<link rel="stylesheet" href="../myCSS/tooltipster.css"></link>
		<link rel="stylesheet" href="../myCSS/tooltipster-noir.css"></link>

		<script>
			$(document).ready(function(){
				<? foreach( $ro4->ending_inventory_list_stockCardNo() as $stockCardNo ) { ?>
					$(".details<? echo $stockCardNo ?>").tooltipster({
						content: $('<span>Loading....</span>'),
						position: 'right',
						theme: 'tooltipster-noir',
						contentAsHTML:true,
						interactive:true,
						functionBefore:function(origin,continueTooltip) {
							continueTooltip();
							if( origin.data('ajax') !== 'cached' ){ 
								$.ajax({
									type:'POST',
									url:'ending-inventory-details.php',
									data:{stockCardNo:'<? echo $stockCardNo ?>',quarter:'<? echo $quarter ?>'},
									success:function(data) {
										origin.tooltipster('content',data).data('ajax','');
									}
								});
							}
						}															
					});


					//pharmacy
					$("#reLabel_pharmacy<? echo $stockCardNo ?>").hide();

					$("#pharmacy<? echo $stockCardNo ?>").click(function(){
						var total = $("#pharmacyTotal<? echo $stockCardNo ?>").val();
						var endingNo = '<? echo $ro->tripleSelectNow('endingInventory','endingNo','stockCardNo',$stockCardNo,'quarter',$quarter,'inventoryLocation','PHARMACY') ?>';
						var inventoryLoc = 'PHARMACY';
						var quarter = '<? echo $quarter ?>';

						var data = {
							endingQTY:total,
							endingNo:endingNo,
							inventoryLoc:inventoryLoc,
							quarter:quarter
						};

						$.post("ending-inventory-add.php",data,function(result){
							$("#pharmacy<? echo $stockCardNo ?>").remove();
							$("#reLabel_pharmacy<? echo $stockCardNo ?>").show();
						});

					});

					//NURSING
					$("#reLabel_ns<? echo $stockCardNo ?>").hide();

					$("#ns<? echo $stockCardNo ?>").click(function(){
						var total = $("#nsTotal<? echo $stockCardNo ?>").val();
						var endingNo = '<? echo $ro->tripleSelectNow('endingInventory','endingNo','stockCardNo',$stockCardNo,'quarter',$quarter,'inventoryLocation','NURSING') ?>';
						var inventoryLoc = 'NURSING';
						var quarter = '<? echo $quarter ?>';
						
						var data = {
							endingQTY:total,
							endingNo:endingNo,
							inventoryLoc:inventoryLoc,
							quarter:quarter
						};

						$.post("ending-inventory-add.php",data,function(result){
							$("#ns<? echo $stockCardNo ?>").remove();
							$("#reLabel_ns<? echo $stockCardNo ?>").show();
						});

					});

					//ER
					$("#reLabel_er<? echo $stockCardNo ?>").hide();

					$("#er<? echo $stockCardNo ?>").click(function(){
						var total = $("#erTotal<? echo $stockCardNo ?>").val();
						var endingNo = '<? echo $ro->tripleSelectNow('endingInventory','endingNo','stockCardNo',$stockCardNo,'quarter',$quarter,'inventoryLocation','E.R') ?>';
						var inventoryLoc = 'E.R';
						var quarter = '<? echo $quarter ?>';		
						
						var data = {
							endingQTY:total,
							endingNo:endingNo,
							inventoryLoc:inventoryLoc,
							quarter:quarter
						};

						$.post("ending-inventory-add.php",data,function(result){
							$("#er<? echo $stockCardNo ?>").remove();
							$("#reLabel_er<? echo $stockCardNo ?>").show();
						});										

					});

					//OR
					$("#reLabel_or<? echo $stockCardNo ?>").hide();

					$("#or<? echo $stockCardNo ?>").click(function(){
						var total = $("#orTotal<? echo $stockCardNo ?>").val();
						var endingNo = '<? echo $ro->tripleSelectNow('endingInventory','endingNo','stockCardNo',$stockCardNo,'quarter',$quarter,'inventoryLocation','OR') ?>';
						var inventoryLoc = 'OR';
						var quarter = '<? echo $quarter ?>';	

						var data = {
							endingQTY:total,
							endingNo:endingNo,
							inventoryLoc:inventoryLoc,
							quarter:quarter
						};

						$.post("ending-inventory-add.php",data,function(result){
							$("#or<? echo $stockCardNo ?>").remove();
							$("#reLabel_or<? echo $stockCardNo ?>").show();
						});														

					});

				<? } ?>
			});
		</script>

	</head>
	<body>
		<div class="container">
			<h3>Ending Inventory Consolidation</h3>
			<div class="col-md-7">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Stock#</th>
							<th>Particulars</th>
							<th>End QTY</th>
							<th>Pharmacy</th>
							<th>N.Station</th>
							<th>E.R</th>
							<th>O.R</th>
							<th>Cost</th>
						</tr>
					</thead>
					<tbody>
						<? for( $a=0,$b=0;$a<count( $ro4->ending_inventory_list_stockCardNo() ),$b<count( $ro4->ending_inventory_list_totalCost() );$a++,$b++ ) { ?>
							<? $stockCardNo = $ro4->ending_inventory_list_stockCardNo()[$a]; ?>
								<tr>
									<td>
										<?
											echo $ro4->ending_inventory_list_stockCardNo()[$a];
											$totalItems += 1;
										?>
									</td>
									<td>
										<span class="details<? echo $stockCardNo ?>">
											<? if( $ro->selectNow("inventoryStockCard","inventoryType","stockCardNo",$stockCardNo) == "medicine" ) { ?>
											<?
												echo $ro->selectNow("inventoryStockCard","genericName","stockCardNo",$stockCardNo)
											?>
											<h6>
												<?
													echo $ro->selectNow("inventoryStockCard","description","stockCardNo",$stockCardNo)
												?>
											</h6>
											<? }else { ?>
												<?
													echo $ro->selectNow("inventoryStockCard","description","stockCardNo",$stockCardNo)
												?>
											<? } ?>
										</span>
									</td>
									<td>
										<?
											echo $ro4->ending_inventory_sumQTY($stockCardNo,$quarter,"")
										?>
									</td>
									<td>
										<? $pharmacy = $ro4->ending_inventory_sumQTY($stockCardNo,$quarter,"PHARMACY") ?>
										<? $isEncoded =$ro->tripleSelectNow("endingInventory","encoded","stockCardNo",$stockCardNo,"inventoryLocation","PHARMACY","quarter",$quarter)  ?>

										<? if( $isEncoded == "" ) { ?>
											<a href="#" id="pharmacy<? echo $stockCardNo ?>">
												<input type="hidden" id="pharmacyTotal<? echo $stockCardNo ?>" value="<? echo $pharmacy ?>">
												<? echo $pharmacy ?>
											</a>
											<span id="reLabel_pharmacy<? echo $stockCardNo ?>">
												<? echo $pharmacy ?>
											</span>
										<? }else { ?>
											<? echo $pharmacy ?>
										<? } ?>
									</td>
									<td>
										<? $ns = $ro4->ending_inventory_sumQTY($stockCardNo,$quarter,"NURSING") ?>
										<? $isEncoded = $ro->tripleSelectNow("endingInventory","encoded","stockCardNo",$stockCardNo,"inventoryLocation","NURSING","quarter",$quarter) ?>

										<? if( $isEncoded == "" ) { ?>
											<a href="#" id="ns<? echo $stockCardNo ?>">
												<input type="hidden" id="nsTotal<? echo $stockCardNo ?>" value="<? echo $ns ?>">
												<? echo $ns ?>
											</a>
											<span id="reLabel_ns<? echo $stockCardNo ?>">
												<? echo $ns ?>
											</span>
										<? }else { ?>
											<? echo $ns ?>
										<? } ?>
									</td>
									<td>
										<? $er = $ro4->ending_inventory_sumQTY($stockCardNo,$quarter,"E.R") ?>
										<? $isEncoded = $ro->tripleSelectNow("endingInventory","encoded","stockCardNo",$stockCardNo,"inventoryLocation","E.R","quarter",$quarter) ?>

										<? if( $isEncoded == "" ) { ?>
											<a href="#" id="er<? echo $stockCardNo ?>">
												<input type="hidden" id="erTotal<? echo $stockCardNo ?>" value="<? echo $er ?>">
												<? echo $er ?>
											</a>
											<span id="reLabel_er<? echo $stockCardNo ?>">
												<? echo $er ?>
											</span>
										<? }else { ?>
											<? echo $er ?>
										<? } ?>
									</td>
									<td>
										<? $or = $ro4->ending_inventory_sumQTY($stockCardNo,$quarter,"OR") ?>
										<? $isEncoded = $ro->tripleSelectNow("endingInventory","encoded","stockCardNo",$stockCardNo,"inventoryLocation","OR","quarter",$quarter) ?>

										<? if( $isEncoded == "" ) { ?>
											<a href="#" id="or<? echo $stockCardNo ?>">
												<input type="hidden" id="orTotal<? echo $stockCardNo ?>" value="<? echo $or ?>">
												<? echo $or ?>
											</a>
											<span id="reLabel_or<? echo $stockCardNo ?>">
												<? echo $or ?>											
											</span>
										<? }else { ?>
											<? echo $or ?>
										<? } ?>
									</td>									
									<td>
										<?
											( $ro4->ending_inventory_list_totalCost()[$b] > 0 ) ? $x = number_format($ro4->ending_inventory_list_totalCost()[$b],2) : $x = "";
											echo $x;
											$grandTotalCost += $ro4->ending_inventory_list_totalCost()[$b];
										?>
									</td>									
								</tr>
						<? } ?>
					</tbody>
					<tfoot>
						<tr>
							<td></td>
							<td><? echo $totalItems ?></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td><? echo number_format($grandTotalCost,2) ?></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</body>
</html>
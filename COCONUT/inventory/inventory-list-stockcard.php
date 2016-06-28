<? include "../../myDatabase.php" ?>
<? include "../../myDatabase4.php" ?>
<? $inventoryType = $_GET['inventoryType'] ?>
<? $year = "2016" ?>
<? $totalItems = 0 ?>
<? $firstQuarterTotal = 0 ?>
<? $secondQuarterTotal = 0 ?>
<? $thirdQuarterTotal = 0 ?>
<? $fourthQuarterTotal = 0 ?>
<? //$inventoryType = "medicine" ?>
<? $ro = new database() ?>
<? $ro4 = new database4() ?>
<? $ro4->stock_card_list($inventoryType) ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../../jquery-2.1.4.min.js"></script>
		<script src="../js/jquery.tooltipster.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script src="../../bootstrap-3.3.6/js/bootstrap.js"></script>	 
		<link rel="stylesheet" href="../myCSS/tooltipster.css"></link> 
		<link rel="stylesheet" href="../myCSS/tooltipster-noir.css"></link>	
		
		<script>

			<? foreach( $ro4->stock_card_list_stockCardNo() as $stockCardNo ) { ?>
				$(document).ready(function(){


					$("#medicineBtn").click(function(){
						window.location = "inventory-list-stockcard.php?inventoryType=medicine";	
					});

					$("#suppliesBtn").click(function(){
						window.location = "inventory-list-stockcard.php?inventoryType=supplies";
					});

					$("#firstQuarter<? echo $stockCardNo ?>").tooltipster({
						content: $('<span>Loading....</span>'),
						theme: 'tooltipster-noir',
						contentAsHTML:true,
						functionBefore:function(origin,continueTooltip) {
							continueTooltip();
							if( origin.data('ajax') !== 'cached' ){ 
								$.ajax({
									type:'POST',
									url:'inventory-list-stockcard-invoice.php',
									data:{'stockCardNo':'<? echo $stockCardNo ?>','fromDate':'<? echo $year ?>-01-01','toDate':'<? echo $year ?>-03-31'},
									success:function(data) {
										origin.tooltipster('content',data).data('ajax','cached');
									}
								});
							}
						}						
					});	


					$("#secondQuarter<? echo $stockCardNo ?>").tooltipster({
						content: $('<span>Loading....</span>'),
						theme: 'tooltipster-noir',
						contentAsHTML:true,
						functionBefore:function(origin,continueTooltip) {
							continueTooltip();
							if( origin.data('ajax') !== 'cached' ){ 
								$.ajax({
									type:'POST',
									url:'inventory-list-stockcard-invoice.php',
									data:{'stockCardNo':'<? echo $stockCardNo ?>','fromDate':'<? echo $year ?>-04-01','toDate':'<? echo $year ?>-06-31'},
									success:function(data) {
										origin.tooltipster('content',data).data('ajax','cached');
									}
								});
							}
						}						
					});	

					$("#thirdQuarter<? echo $stockCardNo ?>").tooltipster({
						content: $('<span>Loading....</span>'),
						theme: 'tooltipster-noir',
						contentAsHTML:true,
						functionBefore:function(origin,continueTooltip) {
							continueTooltip();
							if( origin.data('ajax') !== 'cached' ){ 
								$.ajax({
									type:'POST',
									url:'inventory-list-stockcard-invoice.php',
									data:{'stockCardNo':'<? echo $stockCardNo ?>','fromDate':'<? echo $year ?>-07-01','toDate':'<? echo $year ?>-09-31'},
									success:function(data) {
										origin.tooltipster('content',data).data('ajax','cached');
									}
								});
							}
						}						
					});	


					$("#fourthQuarter<? echo $stockCardNo ?>").tooltipster({
						content: $('<span>Loading....</span>'),
						theme: 'tooltipster-noir',
						contentAsHTML:true,
						functionBefore:function(origin,continueTooltip) {
							continueTooltip();
							if( origin.data('ajax') !== 'cached' ){ 
								$.ajax({
									type:'POST',
									url:'inventory-list-stockcard-invoice.php',
									data:{'stockCardNo':'<? echo $stockCardNo ?>','fromDate':'<? echo $year ?>-10-01','toDate':'<? echo $year ?>-12-31'},
									success:function(data) {
										origin.tooltipster('content',data).data('ajax','cached');
									}
								});
							}
						}						
					});	


				});	
			<? } ?>

		</script>

	</head>
	<body>
		<div class="container">
			<h3>Purchases</h3>
			<div class="row">
				<div class="btn-group">
					<? if( $inventoryType == "medicine" ) { ?>
						<input type="button" id="medicineBtn" class="btn btn-info" value="medicine">
						<input type="button" id="suppliesBtn" class="btn btn-default" value="supplies">
					<? }else { ?>
						<input type="button" id="medicineBtn" class="btn btn-default" value="medicine">
						<input type="button" id="suppliesBtn" class="btn btn-info" value="supplies">
					<? } ?>
				</div>
			</div>
			<div class="row">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Stock#</th>
							<? if( $inventoryType == "medicine") { ?>
								<th>Generic</th>
							<? } ?>					
							<th>Brand</th>
							<th>BEG. BAL<Br>1/1/<? echo $year ?></th>
							<th>3mth<br>Purchases</th>
							<th>END INVTY<br>3/31/<? echo $year ?></th>
							<th>3 MOS<br>Movement</th>
							<th>3mth<br>Purchases</th>
							<th>END INVTY<br>6/30/<? echo $year ?></th>
							<th>3 MOS<br>Movement</th>
							<th>3mth<br>Purchases</th>
							<th>END INVTY<br>9/30/<? echo $year ?></th>
							<th>3MOS<br>Movement</th>
							<th>3mth<br>Purchases</th>
							<th>END INVTY<br>12/31/<? echo $year ?></th>
							<th>3MOS<br>Movement</th>
						</tr>
					</thead>
					<tbody>
						<? foreach($ro4->stock_card_list_stockCardNo() as $stockCardNo) { ?>
							<? $_1st = $ro4->stockCard_purchases($stockCardNo,$year."-01-01","2016-03-31",$inventoryType); ?>
							<? $_2nd = $ro4->stockCard_purchases($stockCardNo,$year."-04-01","2016-06-31",$inventoryType); ?>
							<? $_3rd = $ro4->stockCard_purchases($stockCardNo,$year."-07-01","2016-09-31",$inventoryType); ?>
							<? $_4th = $ro4->stockCard_purchases($stockCardNo,$year."-10-01","2016-12-31",$inventoryType); ?>
							<? if( $_1st != "" || $_2nd != "" || $_3rd != "" || $_4th != "" ) { ?>
								<? $totalItems += 1 ?>
								<tr>
									<td>
										<h5>
											<?
												echo $stockCardNo
											?>
										</h5>
									</td>
									<? if( $inventoryType == "medicine" ) { ?>
									<td>
										<h5>
											<?
												echo $ro->selectNow("inventoryStockCard","genericName","stockCardNo",$stockCardNo)
											?>
										</h5>
									</td>	
									<? } ?>
									<td>
										<h5>
											<?
												echo $ro->selectNow("inventoryStockCard","description","stockCardNo",$stockCardNo)
											?>
										</h5>
									</td>

									<td>

									</td>

									<td>										
										<h5 id="firstQuarter<? echo $stockCardNo ?>">
											<?
												$firstQuarterTotal += $_1st;
												($_1st > 0) ? $x = number_format($_1st,2) : $x = "";

												echo $x;
											?>
										</h5>										
									</td>

									<td>
										<h5>
											<?
												$endingQTY = $ro4->sum_quantity_endingInventory($stockCardNo,"1st");
												$unitcost = $ro4->sum_unitcost_endingInventory($stockCardNo,"1st");
												echo number_format($unitcost * $endingQTY,2);
											?>
										</h5>									
									</td>

									<td bgcolor="#f5f5f5" >
										<h5>
											<?
												$endingQTY = $ro4->sum_quantity_endingInventory($stockCardNo,"1st");
												$unitcost = $ro4->sum_unitcost_endingInventory($stockCardNo,"1st");
												$_1stMovement = ($_1st - ($unitcost * $endingQTY));
												if( $_1stMovement >= 0 ) {
													echo "<b>".number_format($_1stMovement,2)."</b>";
												}else if( $_1st == "" ) {
													echo "<b>".number_format(abs($_1stMovement),2)."</b>";
												}
												else {
													echo "<font color=red>".number_format($_1stMovement,2)."</font>";
												}	
											?>
										</h5>
									</td>

									<td>
										<h5 id="secondQuarter<? echo $stockCardNo ?>">
											<?
												$secondQuarterTotal += $_2nd;
												($_2nd > 0) ? $x = number_format($_2nd,2) : $x = "";

												echo $x;

											?>
										</h5>
									</td>

									<td>
										<h5>
											<?
												$endingQTY = $ro4->sum_quantity_endingInventory($stockCardNo,"2nd");
												$unitcost = $ro4->sum_unitcost_endingInventory($stockCardNo,"2nd");
												$_2ndEndingInventory = ( $endingQTY * $unitcost );
												if( $_2ndEndingInventory != "" ) {
													echo number_format($_2ndEndingInventory,2);
												}else {
													echo "...";
												}	
											
											?>
										</h5>
									</td>

									<td bgcolor="#f5f5f5">
										<h5>
											<?
												if( $_2ndEndingInventory != "" ) {
													$endingQTY = $ro4->sum_quantity_endingInventory($stockCardNo,"2nd");
													$unitcost = $ro4->sum_unitcost_endingInventory($stockCardNo,"2nd");
													$_2ndMovement = (($_1stMovement + $_2nd) - ($unitcost * $endingQTY));
													if( $_2ndMovement >= 0 ) {
														echo "<b>".number_format($_2ndMovement,2)."</b>";
													}else if( $_2nd == "" ) {
														echo "<b>".number_format(abs($_2ndMovement),2)."</b>";
													}
													else {
														echo "<font color=red>".number_format($_2ndMovement,2)."</font>";
													}	
												}else {

												}

											?>
										</h5>
									</td>

									<td>
										<h5 id="thirdQuarter<? echo $stockCardNo ?>">
											<?
												$thirdQuarterTotal += $_3rd;
												($_3rd > 0) ? $x = number_format($_3rd,2) : $x = "";

												echo $x;
											?>
										</h5>
									</td>

									<td>
										<h5>
											...
										</h5>
									</td>

									<td bgcolor="#f5f5f5">
										<h5>
											
										</h5>
									</td>

									<td>
										<h5 id="fourthQuarter<? echo $stockCardNo ?>">
											<?
												$fourthQuarterTotal += $_4th;
												($_4th > 0) ? $x = number_format($_4th,2) : $x = "";

												echo $x;
											?>
										</h5>
									</td>

									<td>
										<h5>
											...
										</h5>
									</td>	
									
									<td bgcolor="#f5f5f5">
										<h5>
											
										</h5>
									</td>															
								</tr>
								<? } ?>
						<? } ?>
					</tbody>
					<tfoot>
						<Tr>
							<td></td>
							<td><? echo $totalItems." Items" ?></td>
							<? if( $inventoryType == "medicine" ) { ?>
							<td></td>
							<? } ?>
							<td>BEG BAL</td>
							<td>
								<?
									($firstQuarterTotal > 0) ? $x = number_format($firstQuarterTotal,2) : $x = "";
									echo $x;									
								?>
							</td>
							<td>END INVTY</td>
							<td>movement</td>
							<td>
								<?
									($secondQuarterTotal > 0) ? $x = number_format($secondQuarterTotal,2) : $x = "";
									echo $x;
								?>
							</td>
							<td>
								<?
									($thirdQuarterTotal > 0) ? $x = number_format($thirdQuarterTotal,2) : $x = "";
									echo $x;
								?>
							</td>
							<td>
								<?
									($fourthQuarterTotal > 0) ? $x = number_format($fourthQuarterTotal,2) : $x = "";
									echo $x;
								?>
							</td>							
						</Tr>
					</tfoot>
				</table>
			</div>
		</div>
	</body>
</html>
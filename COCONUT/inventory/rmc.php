<?
require_once 'class/ending_inventory.class.php';
require_once '../../myDatabase.php';
require_once '../../myDatabase4.php';

$ro = new database();
$ro4 = new database4();
$ending = new ending_inventory();

$quarter = $_POST['quarter'];

$medicine = 'medicine';
$supplies = 'supplies';

$ending->ending_inventory($quarter);

?>
<!DOCTYPE html>
<html>
	<head>
	  <meta charset="UTF-8">
	  <link rel="stylesheet" href='../../bower_components/bootstrap/dist/css/bootstrap.min.css'>
	  <script src='../../bower_components/jquery/dist/jquery.min.js'></script>
	  <title></title>

	  <script>
	  	
	  	$(document).ready(function() {

			$("#export").click(function() {
				
				var inventory = '<table>'+$("#inventory").html().replace(/<a\/?[^>]+>/gi, '')+'</table>';
				var reportName = 'Ending Inventory';

				$('body').prepend("<form method='post' action='../../../export-to-excel/exporttoexcel.php' style='display:none' id='ReportTableData'><textarea name='tableData'>"+inventory+"</textarea><input type='text' name='reportName' value='"+reportName+"'></form>");

				 $('#ReportTableData').submit().remove();
				 return false;	
				 
			});
 		
	  	});	  	

	  </script>
	  
	</head>
	<body>
		<div class='container'>
			<h3>
				<? echo $quarter ?> Quarter
			</h3>
			<h1><a href="#" id="export"><img src="../../../export-to-excel/excel-icon.png"></a></h1>
			
			<table style='border:1px solid black;' id='inventory' class='table table-hover'>
				<thead>
					<tr>
						<th style="border:1px solid black">PRODUCT/INVENTORY CODE</th>
						<th style="border:1px solid black">ITEM DESCRIPTION</th>
						<th style="border:1px solid black">ADDRESS</th>
						<th style="border:1px solid black">CODE</th>
						<th style="border:1px solid black">REMARKS</th>
						<th style="border:1px solid black">INVENTORY VALUATION METHOD (Note2)</th>
						<th style="border:1px solid black">UNIT PRICE</th>
						<th style="border:1px solid black">QUANTITY IN STOCKS</th>
						<th style="border:1px solid black">UNIT OF MEASUREMENT (in weight or volume) e.g, kilos,grams,liters,etc</th>
						<th style="border:1px solid black">TOTAL WEIGHT/VOLUME</th>
						<th style="border:1px solid black">TOTAL COST</th>
					</tr>
				</thead>
				<tbody>
					<? foreach( $ending->ending_inventory_endingNo() as $endingNo ) { ?>

						<?

							$stockCardNo = $ro->selectNow('endingInventory','stockCardNo','endingNo',$endingNo);
							$inventoryType = $ro->selectNow('inventoryStockCard','inventoryType','stockCardNo',$stockCardNo);

						?>

						<!--MEDICINE-->
						<? if( $inventoryType == $medicine ) { ?>
							<tr>
								<!--PRODUCT/INVENTORY CODE-->
								<td style="border:1px solid black">
									<?
										echo $stockCardNo
									?>
								</td>

								<!--ITEM DESCRIPTION-->
								<td style="border:1px solid black">
									<?
										echo $ro->selectNow('inventoryStockCard','description','stockCardNo',$stockCardNo)
									?>
								</td>

								<!--ADDRESS-->
								<td style="border:1px solid black">
									<?
										$inventoryLocation = $ro->selectNow('endingInventory','inventoryLocation','endingNo',$endingNo);
										echo $inventoryLocation;
									?>
								</td>

								<!--CODE-->
								<td style="border:1px solid black"> </td>

								<!--REMARKS-->
								<td style="border:1px solid black"> </td>

								<!--INVENTORY VALUATION METHOD (Note 2)-->
								<td style="border:1px solid black"> </td>

								<!--UNIT PRICE-->
								<td style="border:1px solid black"> 
									<?
										$unitcost = $ro->selectNow('endingInventory','unitcost','endingNo',$endingNo); 
										echo $ro4->number_format($unitcost);
									?>
								</td>

								<!--QTY IN STOCKS-->
								<td style="border:1px solid black">
									<?
										$qty = $ro4->ending_inventory_sumQTY($stockCardNo,$quarter,$inventoryLocation);
										echo $qty;
									?>
								</td>

								<!--UNIT IN MEASUREMENT-->
								<td style="border:1px solid black">
									<?
										echo $ro->selectNow('inventory','preparation','stockCardNo',$stockCardNo);
									?>
								</td>

								<!--TOTAL WEIGHT/VOLUME-->
								<td style="border:1px solid black"> </td>

								<!--TOTAL COST-->
								<td style="border:1px solid black">
									<?
										$totalCost = ( $unitcost * $qty );
										echo $ro4->number_format($totalCost)
									?>
								</td>

							</tr>
						<? }else {  } ?>


						<!--SUPPLIES-->
						<? if( $inventoryType == $supplies ) { ?>
							<tr>
								<!--PRODUCT/INVENTORY CODE-->
								<td style="border:1px solid black">
									<?
										echo $stockCardNo
									?>
								</td>

								<!--ITEM DESCRIPTION-->
								<td style="border:1px solid black">
									<?
										echo $ro->selectNow('inventoryStockCard','description','stockCardNo',$stockCardNo)
									?>
								</td>

								<!--ADDRESS-->
								<td style="border:1px solid black">
									<?
										$inventoryLocation = $ro->selectNow('endingInventory','inventoryLocation','endingNo',$endingNo);
										echo $inventoryLocation;
									?>
								</td>

								<!--CODE-->
								<td style="border:1px solid black"> </td>

								<!--REMARKS-->
								<td style="border:1px solid black"> </td>

								<!--INVENTORY VALUATION METHOD (Note 2)-->
								<td style="border:1px solid black"> </td>

								<!--UNIT PRICE-->
								<td style="border:1px solid black"> 
									<?
										$unitcost = $ro->selectNow('endingInventory','unitcost','endingNo',$endingNo); 
										echo $ro4->number_format($unitcost);
									?>
								</td>

								<!--QTY IN STOCKS-->
								<td style="border:1px solid black">
									<?
										$qty = $ro4->ending_inventory_sumQTY($stockCardNo,$quarter,$inventoryLocation);
										echo $qty;
									?>
								</td>

								<!--UNIT IN MEASUREMENT-->
								<td style="border:1px solid black">
									<?
										echo $ro->selectNow('inventory','preparation','stockCardNo',$stockCardNo);
									?>
								</td>

								<!--TOTAL WEIGHT/VOLUME-->
								<td style="border:1px solid black"> </td>

								<!--TOTAL COST-->
								<td style="border:1px solid black">
									<?
										$totalCost = ( $unitcost * $qty );
										echo $ro4->number_format($totalCost)
									?>
								</td>

							</tr>
						<? }else {  } ?>

					<? } ?>
				</tbody>
			</table>
		</div>
	</body>
</html>
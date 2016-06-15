<? include "../../myDatabase.php" ?>
<? include "../../myDatabase4.php" ?>
<? $inventoryType = $_GET['inventoryType'] ?>
<? $ro = new database() ?>
<? $ro4 = new database4() ?>
<? $ro4->stock_card_list($inventoryType) ?>
<!DOCTYPE html>
<html>
	<head>
	  <meta charset="UTF-8">
	 	<title></title>
	 	<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
	</head>
	<body>
		<div class="container">
			<h3><? echo ucfirst($inventoryType) ?></h3>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Stock#</th>
						<? if( $inventoryType == "medicine") { ?>
							<th>Generic</th>
						<? } ?>					
						<th>Brand</th>
						<th>Quantity</th>
					</tr>
				</thead>
				<tbody>
					<? foreach($ro4->stock_card_list_stockCardNo() as $stockCardNo) { ?>
						<tr>
							<td>
								<?
									echo $stockCardNo
								?>
							</td>
							<? if( $inventoryType == "medicine" ) { ?>
							<td>
								<?
									echo $ro->selectNow("inventoryStockCard","genericName","stockCardNo",$stockCardNo)
								?>
							</td>	
							<? } ?>
							<td>
								<?
									echo $ro->selectNow("inventoryStockCard","description","stockCardNo",$stockCardNo)
								?>
							</td>
							<td>
								&nbsp;&nbsp;
							</td>						

						</tr>
					<? } ?>
				</tbody>
			</table>
		</div>
	</body>
</html>
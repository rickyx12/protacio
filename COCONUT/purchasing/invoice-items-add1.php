<?
include "../../myDatabase.php";
include "../../myDatabase4.php";

$invoiceNo = $_POST['invoiceNo'];
$siNo = $_POST['siNo'];

$ro = new database();
$ro4 = new database4();
$ro4->stock_card_search($_POST['search'])
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>

		<script>
			$(document).ready(function(){

				<? foreach( $ro4->stock_card_search_stockCardNo() as $stockCardNo ) { ?>
					$("#medicineBtn<? echo $stockCardNo ?>").click(function(){
						$("#invoiceItems").load("addMedicine.php",{ stockCardNo:'<? echo $stockCardNo ?>',invoiceNo:'<? echo $invoiceNo ?>',siNo:'<? echo $siNo ?>' });
					});

					$("#suppliesBtn<? echo $stockCardNo ?>").click(function(){
						$("#invoiceItems").load("addSupplies.php",{ stockCardNo:'<? echo $stockCardNo ?>',invoiceNo:'<? echo $invoiceNo ?>',siNo:'<? echo $siNo ?>' });
					});
				<? } ?>

			});
		</script>

	</head>
	<body>
		
			<table id="table" class="table table-hover">
				<thead>
					<tr>
						<th>StockCard#</th>
						<th>Particulars</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<? if( $ro4->stock_card_search_stockCardNo() != "" ) { ?>
						<? foreach( $ro4->stock_card_search_stockCardNo() as $stockCardNo ) { ?>
							<tr>
								<td>
									<? echo $stockCardNo ?>
									<input type="hidden" id="stockCardNo" value="<? echo $stockCardNo ?>">
								</td>
								<td>
									<? echo $ro->selectNow("inventoryStockCard","genericName","stockCardNo",$stockCardNo) ?>
									<br>
									<font size=2><? echo $ro->selectNow("inventoryStockCard","description","stockCardNo",$stockCardNo) ?></font>
								</td>
								<td>
									<? if( $ro->selectNow("inventoryStockCard","inventoryType","stockCardNo",$stockCardNo) == "medicine" ) { ?>
										<input type="button" id="medicineBtn<? echo $stockCardNo ?>" class="btn btn-success" value="Add">
									<? }else { ?>
										<input type="button" id="suppliesBtn<? echo $stockCardNo ?>" class="btn btn-success" value="Add">
									<? } ?>

								</td>
							</tr>
						<? } ?>
					<? }else {  ?>
						<h3>No Result Available</h3>
					<? } ?>
				</tbody>
			</table>
	
	</body>
</html>
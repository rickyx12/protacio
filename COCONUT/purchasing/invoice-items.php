<? include "../../myDatabase4.php" ?>
<? $invoiceNo = $_GET['invoiceNo'] ?>
<? $supplier = $_GET['supplier'] ?>
<? $terms = $_GET['terms'] ?>
<? $date = $_GET['date'] ?>
<? $siNo = $_GET['siNo'] ?>

<?

	$year = substr($date,0,4);
	$month = substr($date,4,2);
	$day = substr($date,7,2);
	$formatDate = $year."-".$month."-".$day;
?>

<? $ro4 = new database4() ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script>
			$(document).ready(function(){
				$("#addInventory").click(function(){
					var invoiceNo = $("#invoiceNo").val();
					$("#invoiceItems").load("invoice-items-add.php",{invoiceNo:invoiceNo,siNo:<? echo $siNo ?>});
				});	

				$("#viewInventory").click(function(){
					$("#invoiceItems").load("view-invoice-items.php",{siNo:<? echo $siNo ?>});
				});

			});
		</script>
	</head>
	<body>
		<div class="container">
			<div>
				<div class="col-md-5">
					<br>
					<div class="panel panel-info">
						<div class="panel-heading">
							<h5 class="panel-title">
								Invoice
							</h5>
						</div>
						<div class="panel-body">
							<h5>
								Invoice#: <b><? echo $invoiceNo ?></b> 
								<input type="hidden" id="invoiceNo" value="<? echo $invoiceNo ?>">
							</h5>

							<h5>
								Supplier: <b><? echo $supplier ?></b>
							</h5>

							<h5>
								Terms: <b><? echo $terms ?></b>
							</h5>

							<h5>
								Date: <b><? echo $ro4->formatDate($formatDate) ?></b>
							</h5>

							<div class="row">
								<div class="col-md-12 text-right">
									<input type="button" id="viewInventory" class="btn btn-danger" value="View Inventory">
									<input type="button" id="addInventory" class="btn btn-success" value="Add Inventory">
								</div>
							</div>

						</div>
					</div>
				</div>

				<div class="col-md-7">
					<br>
					<div class="panel panel-success">
						<div class="panel-heading">
							<h5 class="panel-title">
								Invoice Item's
							</h5>
						</div>
						<div id="invoiceItems" class="panel-body">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
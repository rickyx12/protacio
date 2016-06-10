<? include "../../myDatabase4.php" ?>
<? $stockCardNo = $_POST['stockCardNo'] ?>
<? $brandName = $_POST['brandName'] ?>
<? $genericName = $_POST['genericName'] ?>
<? $currentQTY = $_POST['currentQTY'] ?>
<? $endingQTY = $_POST['endingQTY'] ?>
<? $dateAdded = $_POST['dateAdded'] ?>
<? $quarter = $_POST['quarter'] ?>
<? $ro4 = new database4(); ?>
<?

	$data = array(
		"stockCardNo" => $stockCardNo,
		"currentQTY" => $currentQTY,
		"endingQTY" => $endingQTY,
		"date" => $dateAdded." ".date("H:i:s"),
		"quarter" => $quarter
	);

	$ro4->insertNow("endingInventory",$data);

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../../jquery-2.1.4.min.js"></script>
	<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
	<script src="../../bootstrap-3.3.6/js/bootstrap.js"></script>
</head>
<body>
	<div class="container">
		<h3>&nbsp;</h3>
		<div class="col-md-3">
			
		</div>

		<div class="col-md-6">
			<div class="alert alert-success text-center">
				Successfully Inserted
			</div>
		</div>

		<div class="col-md-3">
			
		</div>
	</div>
</body>
</html>
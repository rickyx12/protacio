<?
include "../../myDatabase.php";
include "../../myDatabase4.php";

$ro = new database();
$ro4 = new database4();

$stockCardNo = $_POST['stockCardNo'];
$description = $_POST['description'];
$quantity = $_POST['quantity'];
$unitcost = $_POST['unitcost'];
$sellingPrice = $_POST['sellingPrice'];
$expiration = $_POST['expiration'];
$dateAdded = $_POST['dateAdded'];
$inventoryLocation = $_POST['inventoryLocation'];
$criticalLevel = $_POST['criticalLevel'];
$supplier = $_POST['supplier'];
$orNo = $_POST['orNo'];
$remarks = $_POST['remarks'];
$classification = $_POST['classification'];
$lock = $_POST['lock'];
$username = $_POST['username'];

$data = array(
		"stockCardNo" => $stockCardNo,
		"description" => $description,
		"quantity" => $quantity,
		"suppliesUNITCOST" => $unitcost,
		"unitcost" => $sellingPrice,
		"expiration" => $expiration,
		"addedBy" => $username,
		"timeAdded" => date("H:i:s"),
		"dateAdded" => $dateAdded,
		"inventoryLocation" => $inventoryLocation,
		"criticalLevel" => $criticalLevel,
		"inventoryType" => "supplies",
		"supplier" => $supplier,
		"retail" => $orNo,
		"remarks" => $remarks,
		"classification" => $classification,
		"locked" => $lock,
		"beginningCapital" => ($unitcost * $sellingPrice),
		"beginningQTY" => $quantity
	);

$ro4->insertNow("inventory",$data);

?>

<!DOCTYPE html>
<html>
	<head>
	  <meta charset="UTF-8">
	  <title></title>
	  <link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
	</head>
	<body>
		<div class="container">
			<div class="col-md-3">
				
			</div>
			<div class="col-md-6">
				<br><br><br><br>
				<div class="alert alert-success text-center">
					<? echo $description ?> Added to Inventory
				</div>
			</div>
			<div class="col-md-3">
				
			</div>
		</div>
	</body>
</html>
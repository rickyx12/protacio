<?
include "../../myDatabase.php";
include "../../myDatabase4.php";

$ro = new database();
$ro4 = new database4();

$stockCardNo = $_POST['stockCardNo'];
$brandName = $_POST['brandName'];
$genericName = $_POST['genericName'];
$preparation = $_POST['preparation'];
$quantity = $_POST['quantity'];
$unitcost = $_POST['unitcost'];
$opdPrice = $_POST['opdPrice'];
$ipdPrice = $_POST['ipdPrice'];
$expiration = $_POST['expiration'];
$dateAdded = $_POST['dateAdded'];
$inventoryLocation = $_POST['inventoryLocation'];
$criticalLevel = $_POST['criticalLevel'];
$supplier = $_POST['supplier'];
$orNo = $_POST['orNo'];
$remarks = $_POST['remarks'];
$username = $_POST['username'];
$lock = $_POST['lock'];



$data = array(
	"stockCardNo" => $stockCardNo,
	"description" => $brandName,
	"genericName" => $genericName,
	"preparation" => $preparation,
	"unitcost" => $unitcost,
	"quantity" => $quantity,
	"expiration" => $expiration,
	"addedBy" => $username,
	"dateAdded" => $dateAdded,
	"timeAdded" => date("H:i:s"),
	"inventoryLocation" => $inventoryLocation,
	"inventoryType" => "medicine",
	"remarks" => $remarks,
	"criticalLevel" => $criticalLevel,
	"supplier" => $supplier,
	"beginningCapital" => ($unitcost * $quantity),
	"beginningQTY" => $quantity,
	"ipdPrice" => $ipdPrice,
	"opdPrice" => $opdPrice,
	"retail" => $orNo,
	"locked" => $lock
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
					<? echo $brandName." (".$genericName.")" ?> Added to Inventory
				</div>
			</div>
			<div class="col-md-3">
				
			</div>
		</div>
	</body>
</html>
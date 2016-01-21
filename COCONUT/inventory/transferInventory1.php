<?php
include($_SERVER['DOCUMENT_ROOT']."/myDatabase2.php");
$stockCardNo = $_GET['stockCardNo'];
$description = $_GET['description'];
$generic = $_GET['generic'];
$unitcost = $_GET['unitcost'];
$expiration = $_GET['expiration'];
$addedBy = $_GET['addedBy'];
$inventoryType = $_GET['inventoryType'];
$branch = $_GET['branch'];
$transition = $_GET['transition'];
$remarks = $_GET['remarks'];
$preparation = $_GET['preparation'];
$phic = $_GET['phic'];
$added = $_GET['added'];
$criticalLevel = $_GET['criticalLevel'];
$supplier = $_GET['supplier'];
$suppliesUNITCOST = $_GET['suppliesUNITCOST'];
$autoDispense = $_GET['autoDispense'];
$status = $_GET['status'];
$classification = $_GET['classification'];
$ipdPrice = $_GET['ipdPrice'];
$opdPrice = $_GET['opdPrice'];
$unitOfMeasure = $_GET['unitOfMeasure'];
$inventoryCode = $_GET['inventoryCode'];
$quantity = $_GET['quantity'];
$inventoryLocation = $_GET['inventoryLocation'];

$dateAdded = date("Y-m-d");
$timeAdded = date("H:i:s");
$begCapital = "";
$begQTY = "";
$description1 = "";
$genericName1 = "";
$biQTY = "";
$biInventoryCode = "";
$encodedQTY = $quantity;
$ro = new database2();


//pinagkunan ng quantity
$source_QTY = $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode);
//ung natirang quantity pagtapos bawasan
$source_newQTY = ( $source_QTY - $quantity );
$ro->editNow("inventory","inventoryCode",$inventoryCode,"quantity",$source_newQTY);

$ro->transferMedicine($stockCardNo,$description,$generic,$unitcost,$quantity,$expiration,$addedBy,$dateAdded,$timeAdded,$inventoryLocation,$inventoryType,$branch,$transition,$remarks,$preparation,$phic,$added,$criticalLevel,$supplier,$begCapital,$begQTY,$suppliesUNITCOST,$autoDispense,$status,$classification,$description1,$genericName1,$ipdPrice,$opdPrice,$unitOfMeasure,$biQTY,$biInventoryCode,$encodedQTY,$inventoryCode)



?>

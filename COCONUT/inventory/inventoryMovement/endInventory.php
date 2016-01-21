<?php
include($_SERVER['DOCUMENT_ROOT']."/coreClass/inventory/movement/inventoryMovement.php");
include($_SERVER['DOCUMENT_ROOT']."/myDatabase2.php");
$inventoryCode = $_GET['inventoryCode'];
$stockCardNo = $_GET['stockCardNo'];
$description = $_GET['description'];
$genericName = $_GET['genericName'];
$preparation = $_GET['preparation'];
$unitcost = $_GET['unitcost'];
$phicPrice = $_GET['phicPrice'];
$companyPrice = $_GET['companyPrice'];
$quantity = $_GET['quantity'];
$expiration = $_GET['expiration'];
$addedBy = $_GET['addedBy'];
$dateAdded = $_GET['dateAdded'];
$timeAdded = $_GET['timeAdded'];
$inventoryLocation = $_GET['inventoryLocation'];
$inventoryType = $_GET['inventoryType'];
$branch = $_GET['branch'];
$transition = $_GET['transition'];
$remarks = $_GET['remarks'];
$phic = $_GET['phic'];
$added = $_GET['added'];
$criticalLevel = $_GET['criticalLevel'];
$accountTitle = $_GET['accountTitle'];
$supplier = $_GET['supplier'];
$autoDispense = $_GET['autoDispense'];
$status = $_GET['status'];
$beginningCapital = $_GET['beginningCapital'];
$beginningQTY = $_GET['beginningQTY'];
$suppliesUNITCOST = $_GET['suppliesUNITCOST'];
$from_inventoryCode = $_GET['from_inventoryCode'];
$classification = $_GET['classification'];
$ipdPrice = $_GET['ipdPrice'];
$opdPrice = $_GET['opdPrice'];
$invoiceNo = $_GET['invoiceNo'];
$fgQuantity = $_GET['fgQuantity'];
$unitOfMeasure = $_GET['unitOfMeasure'];
$username = "ricky";

$im = new inventoryMovement();
$ro = new database2();


//$im->endInventory($stockCardNo,$description,$genericName,$unitcost,$quantity,$expiration,$addedBy,$dateAdded,$timeAdded,$inventoryLocation,$inventoryType,$branch,$transition,$remarks,$preparation,$phic,$added,$criticalLevel,$supplier,$beginningCapital,$quantity,$suppliesUNITCOST,$autoDispense,$status,$classification,$inventoryCode,$ipdPrice,$opdPrice,$unitOfMeasure,"","","");

$im->endInventory_removeMainItem($inventoryCode,$username,date("Y-m-d"));


echo $description." END!"


?>

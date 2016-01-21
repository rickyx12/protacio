<?php
include("../../../myDatabase2.php");
$packageNo = $_GET['packageNo'];
$inventoryCode = $_GET['inventoryCode'];
$qty = $_GET['qty'];

$ro = new database2();

$desc = $ro->selectNow("inventory","description","inventoryCode",$inventoryCode);
$inventoryType = $ro->selectNow("inventory","inventoryType","inventoryCode",$inventoryCode);
$title = "";

if( $inventoryType == "medicine" ) {
$title = "MEDICINE";
}else {
$title = "SUPPLIES";
}

$ro->editNow("hospitalPackage","packageNo",$packageNo,"packageIncluded_description",$desc."_".$inventoryCode."_".$title);
$ro->editNow("hospitalPackage","packageNo",$packageNo,"packageIncluded_qty",$qty);


echo "<br><br><br><center><font color=red size=4> SUCCESSFULLY UPDATED </font>";


?>

<?php
include("../../../myDatabase2.php");
$inventoryCode = $_GET['inventoryCode'];


$ro = new database2();

//addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$total,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$chargeBy,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$branch,$room)
$sellingPrice=0;
$description = $ro->selectNow("inventory","description","inventoryCode",$inventoryCode);
$inventoryType = $ro->selectNow("inventory","inventoryType","inventoryCode",$inventoryCode);

if( $inventoryType == "medicine" ) {
$sellingPrice = $ro->selectNow("inventory","Added","inventoryCode",$inventoryCode);
}else {
$sellingPrice = $ro->selectNow("inventory","unitcost","inventoryCode",$inventoryCode);
}


$ro->addCharges_cash("UNPAID","OPD",$inventoryCode,$description,$sellingPrice,$discount,$total,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$chargeBy,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$branch,$room)


?>

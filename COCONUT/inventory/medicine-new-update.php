<?php
include "../../myDatabase3.php";

$inventoryCode = $_POST['inventoryCode'];
$description = $_POST['description'];
$generic = $_POST['generic'];
$quantity = $_POST['quantity'];
$unitcost = $_POST['unitcost'];
$ipdPrice = $_POST['ipdPrice'];
$opdPrice = $_POST['opdPrice'];
$expiration = $_POST['expiration'];



$ro = new database3();
/*
echo $inventoryCode."<br>";
echo $description."<br>";
echo $generic."<br>";
echo $quantity."<br>";
echo $unitcost."<br>";
echo $ipdPrice."<br>";
echo $opdPrice."<br>";
*/

//edit history
$beforeEdit_qty = $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode);
$beforeEdit_unitcost = $ro->selectNow("inventory","unitcost","inventoryCode",$inventoryCode);
$beforeEdit_opdPrice = $ro->selectNow("inventory","opdPrice","inventoryCode",$inventoryCode);
$beforeEdit_ipdPrice = $ro->selectNow("inventory","ipdPrice","inventoryCode",$inventoryCode);
$beforeEdit_dateAdded = $ro->selectNow("inventory","dateAdded","inventoryCode",$inventoryCode);
$beforeEdit_timeAdded = $ro->selectNow("inventory","timeAdded","inventoryCode",$inventoryCode);
$beforeEdit_username = $ro->selectNow("inventory","addedBy","inventoryCode",$inventoryCode);
$stockCardNo = $ro->selectNow("inventory","stockCardNo","inventoryCode",$inventoryCode);
$inventoryType = $ro->selectNow("inventory","inventoryType","inventoryCode",$inventoryCode);
$ro->editedInventory($stockCardNo,$inventoryCode,$description,$generic,$beforeEdit_qty,$beforeEdit_unitcost,$beforeEdit_opdPrice,$beforeEdit_ipdPrice,$inventoryType,$beforeEdit_timeAdded,$beforeEdit_dateAdded,$beforeEdit_username);


//inventory adjustment
$currentQTY = $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode);
$invoiceNo = $ro->selectNow("inventory","invoiceNo","inventoryCode",$inventoryCode);
if( $currentQTY != $quantity ) {
$terms = $ro->selectNow("salesInvoice","terms","invoiceNo",$invoiceNo) ;
$originalUnitCost = $ro->selectNow("inventory","unitcost","inventoryCode",$inventoryCode);
$qtyDifference = ( $quantity - $currentQTY );
$totalOfUnitCost = ( $unitcost * $qtyDifference );
$lessVAT = ( $totalOfUnitCost / 1.12 );
$inputVAT = ( $lessVAT * 0.12 );
$accountPayables = ( $originalUnitCost * $qtyDifference );

if( $terms != "" ) {
	if( $terms != "CASH" || $terms != "C.O.D" || $terms != "Retail" ) {
	$terms1 = "ACCOUNTS PAYABLE";
	}else {
	$terms1 = "CASH";
	}
}else {
	$terms1 = "CASH";	
}


$ro->inventoryAdjustment($inventoryCode,$stockCardNo,"INVENTORY",$qtyDifference,$qtyDifference,"",date("Y-m-d"));
$ro->inventoryAdjustment($inventoryCode,$stockCardNo,"INPUT VAT",round($inputVAT,2),round($inputVAT,2),"",date("Y-m-d"));
$ro->inventoryAdjustment($inventoryCode,$stockCardNo,$terms1,round($accountPayables,2),"",round($accountPayables,2),date("Y-m-d"));
echo $qtyDifference;
echo "<br>";
echo $inputVAT;
echo "<br>";
echo $accountPayables;
echo "<br>";
echo $terms1;
}else {
//do nothing
}

$ro->editNow("inventory","inventoryCode",$inventoryCode,"description",$description);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"genericName",$generic);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"quantity",$quantity);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"unitcost",$unitcost);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"ipdPrice",$ipdPrice);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"opdPrice",$opdPrice);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"expiration",$expiration);

?>
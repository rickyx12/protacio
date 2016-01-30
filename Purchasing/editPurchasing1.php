<?php
include("../myDatabase.php");
$inventoryCode = $_POST['inventoryCode'];
$refNo = $_POST['refNo'];
$description = $_POST['description'];
$generic = $_POST['generic'];
$unitcost = $_POST['unitcost'];
$qty = $_POST['qty'];
$fgqty = $_POST['fgqty'];
$unit = $_POST['unit'];
$sino = $_POST['sino'];
$page = $_POST['page'];
$username = $_POST['username'];
$ro = new database();

$ro->editNow("salesInvoiceItems","refNo",$refNo,"description",$description);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"description",$description);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"genericName",$generic);
$ro->editNow("salesInvoiceItems","refNo",$refNo,"unitPrice",$unitcost);

if( $ro->selectNow("inventory","inventoryType","inventoryCode",$inventoryCode) == "medicine" ) {
$ro->editNow("inventory","inventoryCode",$inventoryCode,"unitcost",$unitcost);
}else {
$ro->editNow("invnetory","inventoryCode",$inventoryCode,"suppliesUNITCOST",$unitcost);
}

$ro->editNow("salesInvoiceItems","refNo",$refNo,"quantity",$qty);
$ro->editNow("salesInvoiceItems","refNo",$refNo,"fgquantity",$fgqty);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"quantity",$qty);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"fgQuantity",$fgqty);
$ro->editNow("salesInvoiceItems","refNo",$refNo,"unit",$unit);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"preparation",$unit);

$ro->gotoPage("http://".$ro->getMyUrl()."/Purchasing/CreatedReceivingReport.php?username=$username&sino=$sino&page=$page&username=$username");

?>
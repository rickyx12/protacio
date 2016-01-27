<?php
include("../../../myDatabase3.php");
$description = $_GET['description'];
$generic = $_GET['generic'];
$unitcost = $_GET['unitcost'];
$quantity = $_GET['quantity'];
$expiration = $_GET['expiration'];
$dateAdded = $_GET['dateAdded'];
$timeAdded = $_GET['timeAdded'];
$inventoryType = $_GET['inventoryType'];
$inventoryLocation = $_GET['inventoryLocation'];
$inventoryCode = $_GET['inventoryCode'];
$stockCardNo = $_GET['stockCardNo'];
$branch = $_GET['branch'];
$transition = $_GET['transition'];
$remarks = $_GET['remarks'];
$phic = $_GET['phic'];
$preparation = $_GET['preparation'];
$pricing = $_GET['pricing'];
$additional = $_GET['additional'];
$criticalLevel = $_GET['criticalLevel'];
$supplier = $_GET['supplier'];
$phicPrice = $_GET['phicPrice'];
$companyPrice = $_GET['companyPrice'];
$lock = $_GET['lock'];
$username = $_GET['username'];
$ipdPrice = $_GET['ipdPrice'];
$opdPrice = $_GET['opdPrice'];
$invoiceNo = $_GET['invoiceNo'];
$terms1 = "";
$ro = new database3();


//if( $inventoryType == "medicine" ) {
//echo "<script type='text/javascript'> alert('Pls input the price of the medicine..');history.back(-1); </script>";
//}else {

//inventory adjustment
$currentQTY = $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode);
if( $currentQTY != $quantity ) {
$terms = $ro->selectNow("salesInvoice","terms","invoiceNo",$invoiceNo) ;
$originalUnitCost = $ro->selectNow("inventory","unitcost","inventoryCode",$inventoryCode);
$qtyDifference = ( $quantity - $currentQTY );
$totalOfUnitCost = ( $unitcost * $qtyDifference );
$lessVAT = ( $totalOfUnitCost / 1.12 );
$inputVAT = ( $lessVAT * 0.12 );
$accountPayables = ( $originalUnitCost * $qtyDifference );

if( $terms != "CASH" || $terms != "C.O.D" || $terms != "Retail" ) {
$terms1 = "ACCOUNTS PAYABLE";
}else {
$terms1 = "CASH";
}

$ro->inventoryAdjustment($inventoryCode,$stockCardNo,"INVENTORY",$qtyDifference,$qtyDifference,"",date("Y-m-d"));
$ro->inventoryAdjustment($inventoryCode,$stockCardNo,"INPUT VAT",round($inputVAT,2),round($inputVAT,2),"",date("Y-m-d"));
$ro->inventoryAdjustment($inventoryCode,$stockCardNo,$terms1,round($accountPayables,2),"",round($accountPayables,2),date("Y-m-d"));
}else {
//do nothing
}

$ro->editNow("inventory","inventoryCode",$inventoryCode,"description",$description);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"genericName",$generic);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"unitcost",$unitcost);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"quantity",$quantity);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"expiration",$expiration);	
$ro->editNow("inventory","inventoryCode",$inventoryCode,"dateAdded",$dateAdded);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"timeAdded",$timeAdded);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"inventoryType",$inventoryType);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"inventoryLocation",$inventoryLocation);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"branch",$branch);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"transition",$transition);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"remarks",$remarks);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"preparation",$preparation);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"phic",$phic);
//$ro->editNow("inventory","inventoryCode",$inventoryCode,"Added",$pricing."_".$additional);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"criticalLevel",$criticalLevel);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"supplier",$supplier);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"locked",$lock);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"ipdPrice",$ipdPrice);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"opdPrice",$opdPrice);
if( $inventoryType == "medicine" ) {
$ro->editNow("inventory","inventoryCode",$inventoryCode,"beginningCapital", $unitcost * $quantity  );
}else {

}

$ro->editNow("inventory","inventoryCode",$inventoryCode,"phicPrice",$phicPrice);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"companyPrice",$companyPrice);
//}

echo "$description Update Done.";

//$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/masterfile/inventory.php?username=$username&inventoryType=$inventoryType&branch=All&show=All");

?>

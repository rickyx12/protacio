<?php
include("../../myDatabase3.php");
$itemNo = $_GET['itemNo'];
$count = count($itemNo);
$registrationNo = $_GET['registrationNo'];
$type = $_GET['type'];

$ro = new database3();

$price = "";

for( $x=0; $x<$count ;$x++  ) {
echo $itemNo[$x];

if( $type == "OPD" ) {

if( $ro->selectNow("patientCharges","title","itemNo",$itemNo[$x]) == "MEDICINE" || $ro->selectNow("patientCharges","title","itemNo",$itemNo[$x]) == "SUPPLIES" ) {
$sellingPrice = $ro->selectNow("inventory","opdPrice","inventoryCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo[$x]));
}else {
$sellingPrice = $ro->selectNow("availableCharges","OPD","chargesCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo[$x]));
}

}else {

if( $ro->selectNow("patientCharges","title","itemNo",$itemNo[$x]) == "MEDICINE" || $ro->selectNow("patientCharges","title","itemNo",$itemNo[$x]) == "SUPPLIES" ) {
$sellingPrice = $ro->selectNow("inventory","ipdPrice","inventoryCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo[$x]));
}else {
$sellingPrice = $ro->selectNow("availableCharges","PRIVATE","chargesCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo[$x]));
}

}

$qty = $ro->selectNow("patientCharges","quantity","itemNo",$itemNo[$x]);

$total = ( $sellingPrice * $qty );


$ro->updatePriceNow_inventory($registrationNo,$itemNo[$x],$sellingPrice,$total);

}

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/updatePrice.php?registrationNo=$registrationNo");

?>

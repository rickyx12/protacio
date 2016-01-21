<?php
include("../../../myDatabase1.php");
$itemNo = $_GET['itemNo'];
$count = count($itemNo);
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$type = $_GET['type'];

$ro = new database1();

for($x=0;$x<$count;$x++) {

//echo "<br>".$itemNo[$x];

if( $type == "PhilHealth" ) {
$ro->getPatientChargesToEdit($itemNo[$x]);

if( $ro->selectNow("patientCharges","title","itemNo",$itemNo[$x]) == "MEDICINE" || $ro->selectNow("patientCharges","title","itemNo",$itemNo[$x]) == "SUPPLIES" ) {
$newPrice = ( $ro->getInventoryPrice($ro->patientCharges_chargesCode()) + ( $ro->getInventoryPrice($ro->patientCharges_chargesCode()) * 0.25) ); 
}else {
$newPrice = ( $ro->selectNow("availableCharges","OPD","chargesCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo[$x])) + ( $ro->selectNow("availableCharges","OPD","chargesCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo[$x])) * 0.25 ) );
}

//phic Price
//$newTotal = ($newPrice * $ro->patientCharges_quantity());
}else if( $type == "CASH" ) {
$ro->getPatientChargesToEdit($itemNo[$x]);
if( $ro->selectNow("patientCharges","title","itemNo",$itemNo[$x]) == "MEDICINE" || $ro->selectNow("patientCharges","title","itemNo",$itemNo[$x]) == "SUPPLIES" ) {
$newPrice = ( $ro->getInventoryPrice($ro->patientCharges_chargesCode())  ); //phic Price
}else {
$newPrice = ( $ro->selectNow("availableCharges","OPD","chargesCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo[$x])) );
}

///$newTotal = ($newPrice * $ro->patientCharges_quantity());
}else {
$ro->getPatientChargesToEdit($itemNo[$x]);
if( $ro->selectNow("patientCharges","title","itemNo",$itemNo[$x]) == "MEDICINE" || $ro->selectNow("patientCharges","title","itemNo",$itemNo[$x]) == "SUPPLIES" ) {
$newPrice = ( $ro->getInventoryPrice($ro->patientCharges_chargesCode()) + ( $ro->getInventoryPrice($ro->patientCharges_chargesCode()) * 0.35) ); 
}else {
$newPrice = ( $ro->selectNow("availableCharges","OPD","chargesCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo[$x])) + $ro->selectNow("availableCharges","OPD","chargesCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo[$x])) * 0.35 );
}
//company HMO Price
//$newTotal = ($newPrice * $ro->patientCharges_quantity());
}


$newTotal = ($newPrice * $ro->patientCharges_quantity());

if( $type == "CASH" ) {
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"sellingPrice",$newPrice);
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"total",$newTotal);
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"cashUnpaid",$newTotal);
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"phic","0");
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"company","0");
}else if( $type == "PhilHealth" ) {
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"sellingPrice",$newPrice);
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"total",$newTotal);
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"cashUnpaid","0");
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"phic",$newTotal);
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"company","0");
}else {
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"sellingPrice",$newPrice);
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"total",$newTotal);
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"cashUnpaid","0");
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"phic","0");
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"company",$newTotal);
}



}

//$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/updatePrice/showInventory.php?registrationNo=$registrationNo&username=$username&type=$type");


?>

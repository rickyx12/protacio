<?php
include("../../../myDatabase1.php");
$packageNo = $_GET['packageNo'];
$countz = count($packageNo);
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$batchNo = $_GET['batchNo'];
$unitcost = $_GET['unitcost'];
$Added = $_GET['Added'];

$ro = new database1();

$ro->getPatientProfile($registrationNo);

for( $x=0;$x<$countz;$x++ ) {
$packageIncluded = preg_split ("/\_/", $ro->selectNow("hospitalPackage","packageIncluded_description","packageNo",$packageNo[$x]) );
$itemQTY =  $ro->selectNow("hospitalPackage","packageIncluded_qty","packageNo",$packageNo[$x]); 


//addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$total,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$chargeBy,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$branch,$room)
$sellingPrice;
if($packageIncluded[2] == "OR/DR/ER Fee" || $packageIncluded[2] == "OR/DR/ER FEE" || $packageIncluded[2]  == "LABORATORY" || $packageIncluded[2] == "RADIOLOGY" || $packageIncluded[2] == "ECG" || $packageIncluded[2] == "REHAB" ) {
$services = "Examination";
$chargesPrice = $ro->selectNow("hospitalPackage","Added","packageNo",$packageNo[$x]);

$ro->addCharges_cash("UNPAID",$registrationNo,$packageIncluded[1],$packageIncluded[0],$chargesPrice,"0.00",$chargesPrice,$chargesPrice,"0.00","0.00",$ro->getSynapseTime(),date("Y-m-d"),$username,$services,$packageIncluded[2],"Cash","0.00",$batchNo,$ro->selectNow("hospitalPackage","packageIncluded_qty","packageNo",$packageNo[$x]),$ro->selectNow("inventory","inventoryLocation","inventoryCode",$packageIncluded[1]),$ro->getRegistrationDetails_branch(),$ro->getRegistrationDetails_room(),"","","","","","");

}else if( $packageIncluded[2] == "MEDICINE" ) {
$services = "Medication";
$medPrice = $ro->selectNow("hospitalPackage","Added","packageNo",$packageNo[$x]); 

//original
//$ro->addCharges_cash("UNPAID",$registrationNo,$packageIncluded[1],$packageIncluded[0],$medPrice[1],"0.00",$medPrice[1],$medPrice[1],"0.00","0.00",$ro->getSynapseTime(),date("Y-m-d"),$username,$services,$packageIncluded[2],"Cash","0.00",$batchNo,$ro->selectNow("hospitalPackage","packageIncluded_qty","packageNo",$packageNo[$x]),"PHARMACY",$ro->getRegistrationDetails_branch(),$ro->getRegistrationDetails_room());


if( $ro->selectNow("inventory","autoDispense","inventoryCode",$packageIncluded[1]) == "yes" ) { //check autoDispense
$currentQTY = $ro->selectNow("inventory","quantity","inventoryCode",$packageIncluded[1]); // current qty ng meds sa inventory
$newQTY = ($currentQTY - $itemQTY); // less sa inventory as in qty after ibawas ung desired qty 
$ro->editNow("inventory","inventoryCode",$packageIncluded[1],"quantity",$newQTY); // update qty sa database
$ro->addCharges_cash_autoDispense("UNPAID",$registrationNo,$packageIncluded[1],$packageIncluded[0],$medPrice[1],"0.00","0.00","0.00","0.00","0.00",$ro->getSynapseTime(),date("Y-m-d"),$username,$services,$packageIncluded[2],"Cash","0.00",$batchNo,$itemQTY,$ro->selectNow("inventory","inventoryLocation","inventoryCode",$packageIncluded[1]),$ro->getRegistrationDetails_branch(),$ro->getRegistrationDetails_room(),"dispensedBy_".$username,$ro->getSynapseTime());
}else {
$ro->addCharges_cash("UNPAID",$registrationNo,$packageIncluded[1],$packageIncluded[0],$medPrice,"0.00",$medPrice,$medPrice,"0.00","0.00",$ro->getSynapseTime(),date("Y-m-d"),$username,$services,$packageIncluded[2],"Cash","0.00",$batchNo,$itemQTY,$ro->selectNow("inventory","inventoryLocation","inventoryCode",$packageIncluded[1]),$ro->getRegistrationDetails_branch(),$ro->getRegistrationDetails_room(),"","","");
}


}else if( $packageIncluded[2] == "SUPPLIES" ) {
$services = "Others";

$supPrice = $ro->selectNow("hospitalPackage","Added","packageNo",$packageNo[$x]);
//original
$ro->addCharges_cash("UNPAID",$registrationNo,$packageIncluded[1],$packageIncluded[0],$supPrice,"0.00",$supPrice,$supPrice,"0.00","0.00",$ro->getSynapseTime(),date("Y-m-d"),$username,$services,$packageIncluded[2],"Cash","0.00",$batchNo,$ro->selectNow("hospitalPackage","packageIncluded_qty","packageNo",$packageNo[$x]),"PHARMACY",$ro->getRegistrationDetails_branch(),$ro->getRegistrationDetails_room(),"","","","","","");

//$ro->addCharges_cash("UNPAID",$registrationNo,$packageIncluded[1],$packageIncluded[0],$supPrice,"0.00","0.00","0.00","0.00","0.00",$ro->getSynapseTime(),date("Y-m-d"),$username,$services,$packageIncluded[2],"Cash","0.00",$batchNo,$ro->selectNow("hospitalPackage","packageIncluded_qty","packageNo",$packageNo[$x]),$ro->selectNow("inventory","inventoryLocation","inventoryCode",$packageIncluded[1]),$ro->getRegistrationDetails_branch(),$ro->getRegistrationDetails_room());


}
else {
$services = "PROFESSIONAL FEE";
$sellingPrice = 0;

}

/*
$ro->addCharges_cash("UNPAID",$registrationNo,$packageIncluded[1],$packageIncluded[0],$sellingPrice,"0.00","0.00","0.00","0.00","0.00",$ro->getSynapseTime(),date("M_d_Y"),$username,$services,$packageIncluded[2],"Cash","0.00",$batchNo,$ro->selectNow("hospitalPackage","packageIncluded_qty","packageNo",$packageNo[$x]),"PHARMACY",$ro->getRegistrationDetails_branch(),$ro->getRegistrationDetails_room());
*/ 


$ro->getPatientProfile($registrationNo);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"package",$ro->selectNow("hospitalPackage","packageNo","packageNo",$packageNo[$x])."_".$ro->selectNow("hospitalPackage","packageName","packageNo",$packageNo[$x])."_".$ro->selectNow("hospitalPackage","packagePrice","packageNo",$packageNo[$x]));

/*
if( $ro->selectNow("registrationDetails","prePackage","registrationNo",$registrationNo) == "" ){
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"prePackage",$ro->selectNow("hospitalPackage","packageName","packageNo",$packageNo[$x])."_".$ro->selectNow("registrationDetails","packagePrice","packageNo",$packageNo[$x])."_".$ro->selectNow("hospitalPackage","package_phicPrice","packageNo",$packageNo[$x]));
}else {
/**do nothing**/
//}


}


/*
echo "
<script type='text/javascript'>
window.parent.location.reload();
</script>

";
*/

?>

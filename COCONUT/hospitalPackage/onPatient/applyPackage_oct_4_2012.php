<?php
include("../../../myDatabase1.php");
$packageNo = $_GET['packageNo'];
$countz = count($packageNo);
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database1();

$ro->getPatientProfile($registrationNo);

for( $x=0;$x<$countz;$x++ ) {
$packageIncluded = preg_split ("/\_/", $ro->selectNow("hospitalPackage","packageIncluded_description","packageNo",$packageNo[$x]) );

//addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$total,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$chargeBy,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$branch,$room)

if( $packageIncluded[2]  != "MEDICINE" || $packageIncluded[2] != "PROFESSIONAL FEE") {
$services = "Examination";
}else if( $packageIncluded[2] == "MEDICINE" ) {
$services = "Medication";
}else {
$services = "PROFESSIONAL FEE";
}

$ro->addCharges_cash("UNPAID",$registrationNo,$packageIncluded[1],$packageIncluded[0],"0.00","0.00","0.00","0.00","0.00","0.00",$ro->getSynapseTime(),date("M_d_Y"),$username,$services,$packageIncluded[2],"Cash","0.00","package",$ro->selectNow("hospitalPackage","packageIncluded_qty","packageNo",$packageNo[$x]),"",$ro->getRegistrationDetails_branch(),$ro->getRegistrationDetails_room());
 

}

echo "
<script type='text/javascript'>
window.parent.location.reload();
</script>

";


?>

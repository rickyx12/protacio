<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$targetAmount = $_GET['targetAmount'];
$ro = new database2();


$itemz = preg_split ("/\_/", $ro->getMaximumTotal_rBanny($registrationNo,"MEDICINE") ); 

if( $ro->getTotal("cashUnpaid","MEDICINE",$registrationNo) > 0 ) {
echo "<br><Br><br><br><br>";
echo "<font color=red>R-Banny is Completed the  Room</font><br>";
echo "<font color=red>R-Banny is now Calculating Medicine</font><br>";
echo "Total:&nbsp;".$itemz[0];
echo "<br>";
echo "Item#:&nbsp;".$itemz[1];

$ro->getPatientChargesToEdit($itemz[1]);

if( $targetAmount >= $itemz[0] ) {
$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid","0");
$ro->editNow("patientCharges","itemNo",$itemz[1],"Company","0");
$ro->editNow("patientCharges","itemNo",$itemz[1],"phic",$itemz[0]);
}else {
//echo "<br><Br><br><br><font color=blue size=5>R-Banny is Having a trouble in Computation</font>";
$newCash = ( $itemz[0] - $targetAmount );
$newPHIC = ( $ro->selectNow("patientCharges","total","itemNo",$itemz[1]) - $newCash );
$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid",$newCash);
$ro->editNow("patientCharges","itemNo",$itemz[1],"Company","0");
$ro->editNow("patientCharges","itemNo",$itemz[1],"phic",$newPHIC);
}


$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/rBanny/consumedMeds.php?registrationNo=$registrationNo&targetAmount=$targetAmount");
}else {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/rBanny/consumedSup.php?registrationNo=$registrationNo&targetAmount=$targetAmount");
}


?>

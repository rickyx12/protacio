<?php
include("../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

echo "Pls Wait While Updating the S.O.A";

$ro = new database1();

$ro->getPatientProfile($registrationNo);

$room = preg_split ("/\_/",$ro->getRegistrationDetails_room()); 
$dateIn = preg_split ("/\_/", $ro->getRegistrationDetails_dateRegistered()); 
//$dateIn = preg_split ("/\_/", $ro->doubleSelectNow("patientCharges","dateCharge","registrationNo",$registrationNo,"description",$ro->getRegistrationDetails_room()) ); 
$dateOut = preg_split ("/\_/",$ro->getRegistrationDetails_dateUnregistered()); 



if( $dateIn[0] == $dateOut[0] ) {
//count days kapag magkapareho ung month ng admission at discharge
$totalDays = $dateOut[1] - $dateIn[1];
}else {
//count days kapag magkaiba ung month ng admission at discharge
if($dateIn[0] == "Dec") {
$totalDays = (($dateOut[1] + 31 ) - $dateIn[1] );
}else if( $dateIn[0] == "Jan" ) {
$totalDays = (($dateOut[1] + 31 ) - $dateIn[1] );
}else if( $dateIn[0] == "Feb" ) {
$totalDays = (($dateOut[1] + 28 ) - $dateIn[1] );
}else if( $dateIn[0] == "Mar" ) {
$totalDays = (($dateOut[1] + 31 ) - $dateIn[1] );
}else if( $dateIn[0] == "Apr" ) {
$totalDays = (($dateOut[1] + 30 ) - $dateIn[1] );
}else if( $dateIn[0] == "May" ) {
$totalDays = (($dateOut[1] + 31 ) - $dateIn[1] );
}else if( $dateIn[0] == "Jun" ) {
$totalDays = (($dateOut[1] + 30 ) - $dateIn[1] );
}else if( $dateIn[0] == "Jul" ) {
$totalDays = (($dateOut[1] + 31 ) - $dateIn[1] );
}else if( $dateIn[0] == "Aug" ) {
$totalDays = (($dateOut[1] + 31 ) - $dateIn[1] );
}else if( $dateIn[0] == "Sep" ) {
$totalDays = (($dateOut[1] + 30 ) - $dateIn[1] );
}else if( $dateIn[0] == "Oct" ) {
$totalDays = (($dateOut[1] + 31 ) - $dateIn[1] );
}else if( $dateIn[0] == "Nov" ) {
$totalDays = (($dateOut[1] + 30 ) - $dateIn[1] );
}
else {

}

}
//echo "Total Days&nbsp;".$totalDays;
$totalPrice = ( $ro->doubleSelectNow("patientCharges","sellingPrice","registrationNo",$registrationNo,"description",$ro->getRegistrationDetails_room()) * $totalDays );
$totalPHIC = (500 * $totalDays);
$totalExcess = ($totalPrice - $totalPHIC);
//echo "<br>Total Price&nbsp;".$totalPrice;
//echo "<br>Total PhilHealth&nbsp;".$totalPHIC;
//echo "<br>Total Excess&nbsp;".($totalPrice - $totalPHIC);
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"description",$ro->getRegistrationDetails_room(),"quantity",$totalDays);
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"description",$ro->getRegistrationDetails_room(),"total",$totalPrice);
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"description",$ro->getRegistrationDetails_room(),"phic",$totalPHIC);
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"description",$ro->getRegistrationDetails_room(),"cashUnpaid",$totalExcess);


//addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$total,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$chargeBy,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$branch,$room)





$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/SOAoption/summary.php?registrationNo=$registrationNo&username=$username");


?>

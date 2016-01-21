<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$username = $_GET['username'];
$chiefComplaints = $_GET['chiefComplaints'];
$doctorsOrder = $_GET['doctorsOrder'];

$ro = new database2();

$ro->editNow("registrationDetails","registrationNo",$registrationNo,"initialDiagnosis",$chiefComplaints);

if( $ro->selectNow("SOAP","itemNo","itemNo",$itemNo) == "" ) {
$ro->insert_soap($itemNo,$registrationNo,$chiefComplaints,"","",$doctorsOrder);
}else {
$ro->editNow("SOAP","itemNo",$itemNo,"plan",$doctorsOrder);
}


$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/android/doctor/viewPatient_information.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutHidden("username",$username);
echo "<br><br><br><br><br><center>";
$ro->coconutBoxStart("400","60");
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>


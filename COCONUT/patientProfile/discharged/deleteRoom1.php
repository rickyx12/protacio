<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$chargesCode = $_GET['chargesCode'];
$control = $_GET['control'];
$username = $_GET['username'];

$ro = new database2();

$datedeleted=date("Y-m-d@H:i:s");

if( $control == "delete" ) {
$ro->editNow("room","Description",$chargesCode,"status","Vacant");
//$ro->editNow("registrationDetails","registrationNo",$registrationNo,"room","");
//$ro->deleteRoom_new($registrationNo,$itemNo);

$ro->editNow("patientCharges","itemNo",$itemNo,"status","DELETED_".$username."[".$datedeleted."]");

echo "Room has been Deleted.";
}else {
$ro->editNow("room","Description",$chargesCode,"status","Vacant");
//$ro->editNow("registrationDetails","registrationNo",$registrationNo,"room","");
echo $chargesCode." is now Vacant.";
}


?>

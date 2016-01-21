<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database2();

if( $ro->checkBalance($registrationNo) < 1 ) {
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"dateUnregistered",date("Y-m-d"));
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"timeUnregistered",$ro->getSynapseTime() );
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh","Synapse System" );
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh_date",date("Y-m-d") );
}else {

}


//$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_handler.php?registrationNo=$registrationNo&username=$username");

$ro->gotoPage("http://".$ro->getMyUrl()."/Department/patientDepartmentProfile.php?registrationNo=$registrationNo&module=".$ro->selectNow("registeredUser","module","username",$username)."&username=$username&month=".date("m")."&day=".date("d")."&year=".date("Y")."&fromTime_hour=00&fromTime_minutes=00&fromTime_seconds=00&toTime_hour=24&toTime_minutes=00&toTime_seconds=00&nod=");


?>

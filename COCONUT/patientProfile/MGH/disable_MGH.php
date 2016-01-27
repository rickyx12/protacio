<?php
include("../../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];
$countz = count($registrationNo);

$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];


$ro = new database1();

for( $x=0;$x<$countz;$x++ ) {
$ro->editNow("registrationDetails","registrationNo",$registrationNo[$x],"mgh","");
$ro->editNow("registrationDetails","registrationNo",$registrationNo[$x],"mgh_date","");
}

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/MGH/showMGH.php?month=$month&day=$day&year=$year&username=");



?>

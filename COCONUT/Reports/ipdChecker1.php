<?php
include("../../myDatabase3.php");
$registrationNo = $_GET['registrationNo'];
$count = count($registrationNo);

$ro = new database3();

for( $x=0;$x<$count;$x++ ) {
$ro->editNow("registrationDetails","registrationNo",$registrationNo[$x],"dateUnregistered",$ro->getDateOfLastPayment($registrationNo[$x]));
}



?>

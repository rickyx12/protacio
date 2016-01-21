<?php
include("../../myDatabase3.php");
$registrationNo = $_GET['registrationNo'];
$paymentNo = $_GET['paymentNo'];
$count = count($paymentNo);
$reportDate = $_GET['reportDate'];
$reportShift = $_GET['reportShift'];

$ro = new database3();


for( $x=0;$x<$count;$x++ ) {
$ro->editHistory_ipdPayments($paymentNo[$x],$reportDate,$reportShift);
echo "<font color=red>".$ro->selectNow("patientCharges","description","itemNo",$paymentNo[$x])."</font> Reporting Date:&nbsp;$reportDate......Reporting Shift:&nbsp;$reportShift<Br>";

}


?>

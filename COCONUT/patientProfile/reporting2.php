<?php
include("../../myDatabase3.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$reportDate = $_GET['reportDate'];
$reportShift = $_GET['reportShift'];
$count = count($itemNo);

$ro = new database3();

for( $x=0;$x<$count;$x++ ) {
//$ro->editHistory($itemNo[$x],$reportDate,$reportShift);
echo "<font color=red>".$ro->selectNow("patientCharges","description","itemNo",$itemNo[$x])."</font> Reporting Date:&nbsp;$reportDate......Reporting Shift:&nbsp;$reportShift<Br>";
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"reportShift",$reportShift);
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"datePaid",$reportDate);
}



?>

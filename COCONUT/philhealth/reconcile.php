<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$count = count($registrationNo);
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$checkedNo = $_GET['checkedNo'];
$ro = new database2();

$date = $year."-".$month."-".$day;

for( $x=0;$x<$count;$x++ ) {
$ro->editNow("phicTransmit","registrationNo",$registrationNo[$x],"reconciled","yes");
$ro->editNow("phicTransmit","registrationNo",$registrationNo[$x],"date",$date);
$ro->editNow("phicTransmit","registrationNo",$registrationNo[$x],"checkedNo",$checkedNo);
}
echo "<Font color=red size=4>Completed</font>";



?>

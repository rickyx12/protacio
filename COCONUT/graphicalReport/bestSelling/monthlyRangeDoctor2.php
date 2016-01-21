<?php
include("../../../myDatabase2.php");

$date1 = $_GET['date1'];
$date2 = $_GET['date2'];
$service = $_GET['service'];
$chargesCode = $_GET['chargesCode'];

$ro = new database2();


echo "<center><br>";
echo $ro->selectNow("Doctors","Name","doctorCode",$chargesCode);
echo "<br><font size=2>($date1 to $date2)</font>";
$ro->getTopDoctors_with_px($date1,$date2,"ATTENDING",$chargesCode);

?>

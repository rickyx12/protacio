<?php
include("../../../myDatabase3.php");
$registrationNo = $_GET['registrationNo'];

$ro = new database3();

echo "<center><Br><font color=red>Discharged History</font><Br><br>";

$ro->viewDischargedHistory($registrationNo);


?>
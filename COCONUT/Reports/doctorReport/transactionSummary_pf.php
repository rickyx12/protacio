<?php
include("../../../myDatabase3.php");

$date = $_GET['date'];
$date1 = $_GET['date1'];

$ro = new database3();

echo $date."<Br>";
echo $date1;
echo "<br><br>";
$ro->patientAccountOPD_pf($date,$date1);


?>

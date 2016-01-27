<?php
include("../../../myDatabase3.php");
$doctor = $_GET['doctor'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];

$ro = new database3();

$date = $year."-".$month."-".$day;
$date1 = $year1."-".$month1."-".$day1;

$doctor = $ro->selectNow("Doctors","Name","doctorCode",$doctor);

echo "<br>".$doctor."<br>";
echo $date."<Br>".$date1;

$ro->doctorPatient($doctor,$date,$date1,"OPD");

?>

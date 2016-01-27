<?php
include("../../../myDatabase.php");
$month = $_GET['month'];
$year = $_GET['year'];
$description = $_GET['description'];

$ro = new database();

$ro->coconutFormStart("post","bestSellingChart_ipd.php");
$ro->coconutHidden("month",$month);
$ro->coconutHidden("year",$year);
$ro->coconutHidden("description",$description);
echo "<br><Br>";
$ro->coconutBoxStart("550","90");
echo "<Br>";
echo "You are about to view the Chart of <br> $description for $month $year";
echo "<Br><Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>

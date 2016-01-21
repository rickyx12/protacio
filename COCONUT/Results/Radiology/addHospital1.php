<?php
include("../../../myDatabase1.php");
$hospitalName = $_GET['hospitalName'];
$hospitalAddress = $_GET['hospitalAddress'];
$username = $_GET['username'];

$ro = new database1();

$ro->radioHeading($hospitalName,$hospitalAddress);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Results/Radiology/addHospital.php?username=$username");

?>

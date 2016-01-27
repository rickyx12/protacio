<?php
include("../../myDatabase3.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$from = $_GET['from'];
$ro = new database3();

echo $ro->accumulateBalance($registrationNo);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_handler.php?registrationNo=$registrationNo&username=$username&from=$from");

?>

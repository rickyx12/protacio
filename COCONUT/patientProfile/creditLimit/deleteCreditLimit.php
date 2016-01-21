<?php
include("../../../myDatabase.php");
$limitNo = $_GET['limitNo'];
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];


$ro = new database();

$ro->deleteNow("patientCreditLimit","limitNo",$limitNo);

echo "<script type='text/javascript' >";
echo  "window.location='http://".$ro->getMyUrl()."/COCONUT/patientProfile/creditLimit/viewCreditLimit.php?username=$username&registrationNo=$registrationNo' ";
echo "</script>";

?>

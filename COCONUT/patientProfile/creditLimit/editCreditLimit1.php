<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$limitNo = $_GET['limitNo'];
$username = $_GET['username'];
$limitTo = $_GET['limitTo'];
$limitVia = $_GET['limitVia'];
$amountLimit = $_GET['amountLimit'];

$ro = new database();

$ro->EditNow("patientCreditLimit","limitNo",$limitNo,"limitTo",$limitTo);
$ro->EditNow("patientCreditLimit","limitNo",$limitNo,"limitVia",$limitVia);
$ro->EditNow("patientCreditLimit","limitNo",$limitNo,"amountLimit",$amountLimit);
$ro->EditNow("patientCreditLimit","limitNo",$limitNo,"username",$username);

echo "<script type='text/javascript' >";
echo  "window.location='http://".$ro->getMyUrl()."/COCONUT/patientProfile/creditLimit/viewCreditLimit.php?username=$username&registrationNo=$registrationNo '";
echo "</script>";


?>

<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$refNo = $_GET['refNo'];
$username = $_GET['username'];

$ro = new database2();

$ro->editNow("phicPayment","refNo",$refNo,"status","DELETED_".$username."_".date("Y-m-d"));

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/Payments/viewPHICPayment.php?registrationNo=$registrationNo&username=$username");

?>

<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$batchNo = $_GET['batchNo'];
$username = $_GET['username'];

$ro = new database();

$ro->coconutAjax("1500","http://".$ro->getMyUrl()."/COCONUT/patientProfile/ECART/showCart.php?registrationNo=$registrationNo&batchNo=$batchNo&username=$username");

?>

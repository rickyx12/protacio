<?php
include("../../../myDatabase1.php");
$username = $_GET['username'];
$registrationNo = $_GET['registrationNo'];
$checkz = $_GET['checkz'];
$batchNo = $_GET['batchNo'];
$ro = new database1();

if( $checkz == "no" ) {
echo "<center><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/individualPayment/showMeds.php?username=$username&registrationNo=$registrationNo&checkz=yes&batchNo=$batchNo'><font color='blue'>Check All</font></a><br>";
}else {
echo "<center><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/individualPayment/showMeds.php?username=$username&registrationNo=$registrationNo&checkz=no&batchNo=$batchNo'><font color='red'>Uncheck All</font></a><br>";
}

$ro->getIndividualPayments($registrationNo,$username,$checkz,$batchNo);



?>

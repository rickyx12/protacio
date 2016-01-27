<?php
include("../../../myDatabase2.php");
$refNo = $_POST['refNo'];
$checkNo = $_POST['checkNo'];
$registrationNo = $_POST['registrationNo'];
$amount = $_POST['amount'];
$tax = $_POST['tax'];
$discount = $_POST['discount'];
$company = $_POST['company'];
$month = $_POST['month'];
$day = $_POST['day'];
$year = $_POST['year'];
$postBy = $_POST['postBy'];

$ro = new database2();

$date = $year."-".$month."-".$day;

$ro->addCompanyPayment($refNo,$checkNo,$registrationNo,$amount,$tax,$discount,$company,$date,$postBy);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_right.php?registrationNo=$registrationNo&username=$postBy");

?>

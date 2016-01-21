<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$refNo = $_GET['refNo'];
$amountPaid = $_GET['amountPaid'];
$datePaid = $_GET['datePaid'];
$username = $_GET['username'];

$ro = new database2();
$ro->coconutDesign();

$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/patientProfile/Payments/deleteCompanyPayment1.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("refNo",$refNo);
$ro->coconutHidden("username",$username);
echo "<Br>";
$ro->coconutBoxStart_red("700","80");
echo "<Br>";
echo "Delete The Payment <font color=red>".number_format($amountPaid,2)."</font> that was posted in <font color=red>$datePaid</font>?";
echo "<br><br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>

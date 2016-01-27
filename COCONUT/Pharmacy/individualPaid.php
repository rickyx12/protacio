<?php
include("../../myDatabase1.php");

$registrationNo  = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$username = $_GET['username'];
$module = $_GET['module'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$fromTime_hour = $_GET['fromTime_hour'];
$fromTime_minutes = $_GET['fromTime_minutes'];
$fromTime_seconds = $_GET['fromTime_seconds'];
$toTime_hour = $_GET['toTime_hour'];
$toTime_minutes = $_GET['toTime_minutes'];
$toTime_seconds = $_GET['toTime_seconds'];


$ro = new database1();

//$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"status","PAID");
//$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"cashUnpaid","0.00");

if( $ro->selectNow("patientCharges","title","itemNo",$itemNo) == "MEDICINE" ) {
$price = preg_split ("/\_/", $ro->selectNow("inventory","Added","inventoryCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo)) ); 
$totalPay = ( $price[1] * $ro->selectNow("patientCharges","quantity","itemNo",$itemNo) );
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"status","PAID");
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"cashUnpaid","0.00");
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"phic","0.00");
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"company","0.00");
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"cashPaid",$totalPay);
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"sellingPrice",$price[1]);
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"total",$totalPay);
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"datePaid",date("Y-m-d"));
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"timePaid",$ro->getSynapseTime());
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"paidBy",$username);
}else { //supplies
$totalPay = ( $ro->selectNow("inventory","unitcost","inventoryCode", $ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo) ) * $ro->selectNow("patientCharges","quantity","itemNo",$itemNo) );
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"status","PAID");
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"cashUnpaid","0.00");
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"phic","0.00");
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"company","0.00");
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"cashPaid",$totalPay);
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"sellingPrice",$ro->selectNow("inventory","unitcost","inventoryCode", $ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo) ));
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"total",$totalPay);
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"datePaid",date("Y-m-d"));
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"timePaid",$ro->getSynapseTime());
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo,"paidBy",$username);
}

$ro->gotoPage("http://".$ro->getMyUrl()."/Department/patientDepartmentProfile.php?registrationNo=$registrationNo&module=$module&month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username");


?>

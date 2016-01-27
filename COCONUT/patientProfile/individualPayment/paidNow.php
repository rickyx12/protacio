<?php
include("../../../myDatabase1.php");
$username = $_GET['username'];
$itemNo = $_GET['itemNo'];
$registrationNo = $_GET['registrationNo'];

$ro = new database1();

$ro->doubleEditNow("patientCharges","itemNo",$itemNo,"registrationNo",$registrationNo,"cashPaid",$ro->doubleSelectNow("patientCharges","cashUnpaid","itemNo",$itemNo,"registrationNo",$registrationNo)); // kuhain ang total price at ilagay sa cashPaid cols

$ro->doubleEditNow("patientCharges","itemNo",$itemNo,"registrationNo",$registrationNo,"cashUnpaid","0"); // gwen 0 ang cashUnpaid cols


$ro->doubleEditNow("patientCharges","itemNo",$itemNo,"registrationNo",$registrationNo,"status","PAID"); // tagged as PAID

$ro->doubleEditNow("patientCharges","itemNo",$itemNo,"registrationNo",$registrationNo,"datePaid",date("M_d_Y")); 

$ro->doubleEditNow("patientCharges","itemNo",$itemNo,"registrationNo",$registrationNo,"timePaid",$ro->getSynapseTime()); 

$ro->doubleEditNow("patientCharges","itemNo",$itemNo,"registrationNo",$registrationNo,"paidBy",$username); // gwen 0 ang cashUnpaid cols

$newQty = ( $ro->selectNow("inventory","quantity","inventoryCode", $ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo)) - $ro->selectNow("patientCharges","quantity","itemNo",$itemNo) ); 



$ro->editNow("inventory","inventoryCode",$ro->doubleSelectNow("patientCharges","chargesCode","itemNo",$itemNo,"registrationNo",$registrationNo),"quantity",$newQty);

$ro->doubleEditNow("patientCharges","itemNo",$itemNo,"registrationNo",$registrationNo,"departmentStatus","dispensedBy_".$username); 

$ro->doubleEditNow("patientCharges","itemNo",$itemNo,"registrationNo",$registrationNo,"departmentTime",$ro->getSynapseTime()); 






?>

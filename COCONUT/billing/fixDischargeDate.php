<?php
include "../../myDatabase3.php";
$date = $_GET['date'];
$date1 = $_GET['date1'];
$type = $_GET['type'];
$title = $_GET['title'];
$datePaid = $_GET['datePaid'];
$registrationNo = $_GET['registrationNo'];

$ro = new database();

if($date == $date1) {
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"dateUnregistered",$datePaid);
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/billing/patientAccount.php?date=$date&date1=$date1&type=$type&title=$title");
}else {
echo "Start date and End Date is not match";
}

?>

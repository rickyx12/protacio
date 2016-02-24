<?php
include "../../../myDatabase.php";
$date = $_GET['date'];
$date1 = $_GET['date1'];
$registrationNo = $_GET['registrationNo'];
$datePaid = $_GET['datePaid'];

$ro = new database();
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"dateUnregistered",$datePaid);
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Reports/doctorReport/transactionSummary_pf.php?date=$date&date1=$date1");

?>

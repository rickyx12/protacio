<?php
include("../../../myDatabase.php");
$docName = $_GET['docName'];
$chargesCode = $_GET['chargesCode'];
$date = $_GET['date'];
$date1 = $_GET['date1'];


$ro = new database();

echo "<center><font size=5><b>".$ro->getReportInformation("hmoSOA_name")."</b></font></centeR>";


$ro->getDoctorPatientReport_cash($chargesCode,$docName,$date,$date1);

?>

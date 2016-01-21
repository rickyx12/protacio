<?php
include("../../../myDatabase2.php");
$doctorCode = $_GET['doctorCode'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];
$title = $_GET['title'];

$ro = new database2();
$ro->coconutDesign();
$date = $year."-".$month."-".$day;
$date1 = $year1."-".$month1."-".$day1;

echo "Doctor:".$ro->selectNow("Doctors","Name","doctorCode",$doctorCode);
echo "<Br>";
echo $year."-".$month."-".$day." to ".$year1."-".$month1."-".$day1;
echo "<br><br>";
//$ro->getPxNameBasedOnDateCharged($year."-".$month."-".$day,$year1."-".$month1."-".$day1,"IPD",$doctorCode);
/*
echo "IPD Patients";
$ro->coconutTableStart();
$ro->coconutTableRowStart();
echo "<th>Patient</th>";
echo "<th>Date</th>";
echo "<th>Examinations</th>";
echo "<th>Total</th>";
echo "<th>Rebate</th>";

$ro->coconutTableRowStop();
$ro->coconutTableRowStart();
$ro->getPxNameByAttendingDoctor($doctorCode,$date,$date1,"IPD");
$ro->coconutTableRowStop();
$ro->coconutTableStop();
*/
echo "OPD Patients";
$ro->coconutTableStart();
$ro->coconutTableRowStart();
echo "<th>Patient</th>";
echo "<th>Date</th>";
echo "<th>Examinations</th>";
echo "<th>Total</th>";
echo "<th>Rebate</th>";
$ro->coconutTableRowStop();
$ro->coconutTableRowStart();
$ro->getPxNameByAttendingDoctor($doctorCode,$date,$date1,"OPD",$title);
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("<b>Total</b>");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("&nbsp;".number_format($ro->getPxChargesByHorizontal_grandTotal(),2));
$ro->coconutTableData("&nbsp;".number_format($ro->getPxNameBasedOnDateCharged_rebateTotal(),2));
$ro->coconutTableRowStop();

$ro->coconutTableStop();

?>

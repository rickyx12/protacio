<?php
include("../../myDatabase3.php");

$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];

$ro = new database3();

$date = $year."-".$month."-".$day;
$date1 = $year1."-".$month1."-".$day1;
$otTotal;
$stTotal;


echo $date;
echo "<Br>".$date1;
echo "<br><br>";
$ro->showAllAccountTitle_ipd($date,$date1);
echo "<br><br>";
$ro->ipdPaymentsz($date,$date1);
echo "<hr>";

$ro->showAllAccountTitle_opd($date,$date1);
echo "<br>";
echo "<table border=0 width='80%'>";
echo "<tr>";
echo "<th>&nbsp;Outpatient</th>";
echo "<th>&nbsp;Discount</th>";
echo "<th>&nbsp;UNPAID</th>";
echo "<th>&nbsp;HMO</th>";
echo "<th>&nbsp;PHIC</th>";
echo "<th>&nbsp;HOSPITAL</th>";
echo "<th>&nbsp;DOCTOR</th>";
echo "<th>&nbsp;Cr.CARD</th>";
echo "<th>&nbsp;PAYABLES</th>";
echo "<th>&nbsp;TOTAL</th>";
echo "</tr>";
$ro->showPFaccounts($date,$date1);
$ro->showTherapyAccounts($date,$date1,"OT");
$otTotal = $ro->showTherapyAccounts_total();
$ro->showTherapyAccounts($date,$date1,"ST");
$stTotal = $ro->showTherapyAccounts_total();
echo "</table>";
echo "<br><br><br>";

echo "OPD:&nbsp;".number_format($ro->showPFaccounts_total() + $ro->_opd_totalz() + $otTotal + $stTotal,2);
echo "<Br>";
echo "IPD:&nbsp;".number_format($ro->showAllAccountTitle_ipd_total(),2);
echo "<br>";
echo "Total:&nbsp;".number_format($ro->showPFaccounts_total() + $ro->_opd_totalz + $otTotal + $stTotal + $ro->showAllAccountTitle_ipd_total(),2);


?>

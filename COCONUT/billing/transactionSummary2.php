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



echo $date;
echo "<Br>".$date1;
echo "<br><br>";
$ro->showAllAccountTitle_ipd($date,$date1);
echo "<br><br>";
$ro->ipdPaymentsz($date,$date1);
echo "<hr>";

$ro->showAllAccountTitle_opd($date,$date1);
echo "<br>";
$ro->showPFaccounts($date,$date1);

echo "<br><br><br>";

echo "OPD:&nbsp;".number_format($ro->showPFaccounts_total() + $ro->_opd_totalz(),2);
echo "<Br>";
echo "IPD:&nbsp;".number_format($ro->showAllAccountTitle_ipd_total(),2);
echo "<br>";
echo "Total:&nbsp;".number_format($ro->showPFaccounts_total() + $ro->_opd_totalz + $ro->showAllAccountTitle_ipd_total(),2);


?>

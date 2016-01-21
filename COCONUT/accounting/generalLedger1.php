<?php
include("../../myDatabase2.php");
$accountTitle = $_GET['accountTitle'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];

$ro = new database2();

$date = $year."-".$month."-".$day;
$date1 = $year1."-".$month1."-".$day1;

echo "General Ledger";
echo "<br>";
echo $date." to ".$date1;
echo "<Br>";
echo $accountTitle;
echo "<center><br><br>";

if( $accountTitle == "CASH" )  {
$ro->getGeneralLedger_debit($accountTitle,$date,$date1,"OPD","cashPaid");
}else {
$ro->getGeneralLedger_credit($accountTitle,$date,$date1,"OPD");
}

?>

<?php
include("../../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];

$ro = new database2();

$date1 = $year."-".$month."-".$day;
$date2 = $year1."-".$month1."-".$day1;

$monthWord1 = "";
$monthWord2 = "";

if( $month == "01" ) {
$monthWord1 = "Jan";
}else if( $month == "02" ) {
$monthWord1 = "Feb";
}else if( $month == "03" ) {
$monthWord1 = "Mar";
}else if( $month == "04" ) {
$monthWord1 = "Apr";
}else if( $month == "05" ) {
$monthWord1 = "May";
}else if( $month == "06" ) {
$monthWord1 = "Jun";
}else if( $month == "07" ) {
$monthWord1 = "Jul";
}else if( $month == "08" ) {
$monthWord1 = "Aug";
}else if( $month == "09" ) {
$monthWord1 = "Sep";
}else if( $month == "10" ) {
$monthWord1 = "Oct";
}else if( $month == "11" ) {
$monthWord1 = "Nov";
}else if( $month == "12" ) {
$monthWord1 = "Dec";
}else { }


if( $month1 == "01" ) {
$monthWord2 = "Jan";
}else if( $month1 == "02" ) {
$monthWord2 = "Feb";
}else if( $month1 == "03" ) {
$monthWord2 = "Mar";
}else if( $month1 == "04" ) {
$monthWord2 = "Apr";
}else if( $month1 == "05" ) {
$monthWord2 = "May";
}else if( $month1 == "06" ) {
$monthWord2 = "Jun";
}else if( $month1 == "07" ) {
$monthWord2 = "Jul";
}else if( $month1 == "08" ) {
$monthWord2 = "Aug";
}else if( $month1 == "09" ) {
$monthWord2 = "Sep";
}else if( $month1 == "10" ) {
$monthWord2 = "Oct";
}else if( $month1 == "11" ) {
$monthWord2 = "Nov";
}else if( $month1 == "12" ) {
$monthWord2 = "Dec";
}else { }

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

echo "<center>";
echo "<font size=4><b>Mendero Medical Center</b></font>";
echo "<br>";
echo "<font size=3><b>Daily Cashier's Report</b></font>";
echo "<br>";
echo "<b><i>".$monthWord1." ".$day.", ".$year." - ".$monthWord2." ".$day1." ".$year1."</b></i>";
//echo "<br>";
//echo "SHIFT:&nbsp;8AM-5PM";
echo "<br><br>";
echo "<table border=0 cellspacing=0 width='100%'>";
/*
echo "<tr>";
echo "<Td>OFFICIAL RECEIPTS</td>";
echo "<Td>FROM&nbsp;&nbsp;&nbsp;&nbsp; ".$ro->selectNow("cashCollection","fromOR","date",$year."-".$month."-".$day)."</td>";
echo "<Td>TO&nbsp;&nbsp;&nbsp;&nbsp;".$ro->selectNow("cashCollection","toOR","date",$year."-".$month."-".$day)."</td>";
echo "<tD>&nbsp;</td>";
echo "</tr>";
*/

echo "<tr>";
echo "<Td><b>TOTAL RECEIPTS</b></td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<b>AMOUNT</b></tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;Cash(In-Patient)</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;".number_format($ro->cashCollection_mmc_customTotal_monthly($date1,$date2,"Cash_Inpatient"),2)."</tD>";
echo "<tD>&nbsp;<b>".number_format($ro->cashCollection_mmc_customTotal_monthly($date1,$date2,"Cash_Inpatient"),2)."</b></tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<b>HOSPITAL COLLECTION</b></td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";


$ro->cashCollection_mmc_monthly($date1,$date2,"Hospital Collection");

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;Total Cash:</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;".number_format($ro->cashCollection_mmc_monthly_total(),2)."</tD>";
echo "<tD>&nbsp;<b>".number_format($ro->cashCollection_mmc_monthly_total(),2)."</b></tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";

$hospitalCollection = ($ro->cashCollection_mmc_monthly_total() + $ro->cashCollection_mmc_customTotal_monthly($date1,$date2,"Cash_Inpatient"));
echo "<tr>";
echo "<Td>&nbsp;<b>TOTAL CASH RECEIPTS</b></td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format($hospitalCollection,2)."</b></tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<b>LESS:DISBURSEMENT</b></td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";


$ro->cashCollection_mmc_monthly($date1,$date2,"Disbursement");

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";

$disbursement = $ro->cashCollection_mmc_monthly_total();
echo "<tr>";
echo "<Td>&nbsp;<b>TOTAL DISBURSEMENT</b>:</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;".number_format($ro->cashCollection_mmc_monthly_total(),2)."</tD>";
echo "<tD>&nbsp;<b>".number_format($ro->cashCollection_mmc_monthly_total(),2)."</b></tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;<b>NET CASH RECEIPTS FOR THE DAY</b></td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;".number_format($hospitalCollection - $disbursement,2)."</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";
/*
echo "<tr>";
echo "<Td>&nbsp;PREPARED BY:</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;<b>".$ro->selectNow("cashCollection_preparedBy","preparedBy","date",$year."-".$month."-".$day)."</b></td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;NAME OF BILLING:&nbsp;<b>".$ro->selectNow("cashCollection_preparedBy","billingName","date",$year."-".$month."-".$day)."</b></td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;SHIFT: 8AM-5PM</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";
*/
echo "</table>";

?>

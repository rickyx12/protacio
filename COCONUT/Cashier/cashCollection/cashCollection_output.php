<?php
include("../../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];

$ro = new database2();

$month1 = "";

if( $month == "01" ) {
$month1 = "Jan";
}else if( $month == "02" ) {
$month1 = "Feb";
}else if( $month == "03" ) {
$month1 = "Mar";
}else if( $month == "04" ) {
$month1 = "Apr";
}else if( $month == "05" ) {
$month1 = "May";
}else if( $month == "06" ) {
$month1 = "Jun";
}else if( $month == "07" ) {
$month1 = "Jul";
}else if( $month == "08" ) {
$month1 = "Aug";
}else if( $month == "09" ) {
$month1 = "Sep";
}else if( $month == "10" ) {
$month1 = "Oct";
}else if( $month == "11" ) {
$month1 = "Nov";
}else if( $month == "12" ) {
$month1 = "Dec";
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
echo "DATE:&nbsp;".$month1." ".$day.", ".$year;
echo "<br>";
echo "SHIFT:&nbsp;8AM-5PM";
echo "<br><br>";
echo "<table border=0 cellspacing=0 width='100%'>";
echo "<tr>";
echo "<Td>OFFICIAL RECEIPTS</td>";
echo "<Td>FROM&nbsp;&nbsp;&nbsp;&nbsp; ".$ro->selectNow("cashCollection","fromOR","date",$year."-".$month."-".$day)."</td>";
echo "<Td>TO&nbsp;&nbsp;&nbsp;&nbsp;".$ro->selectNow("cashCollection","toOR","date",$year."-".$month."-".$day)."</td>";
echo "<tD>&nbsp;</td>";
echo "</tr>";


echo "<tr>";
echo "<Td><b>TOTAL RECEIPTS FOR THE DAY</b></td>";
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
echo "<tD>&nbsp;".number_format($ro->doubleSelectNow("cashCollection","amount","date",$year."-".$month."-".$day,"type","Cash_Inpatient"),2)."</tD>";
echo "<tD>&nbsp;<b>".number_format($ro->doubleSelectNow("cashCollection","amount","date",$year."-".$month."-".$day,"type","Cash_Inpatient"),2)."</b></tD>";
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


$ro->cashCollection_mmc($year."-".$month."-".$day,"Hospital Collection");

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";

$hospital = $ro->cashCollection_mmc_total();
echo "<tr>";
echo "<Td>&nbsp;Total Hospital:</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;".number_format($hospital,2)."</tD>";
echo "<tD>&nbsp;<b>".number_format($hospital,2)."</b></tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<b>PHARMACY COLLECTION</b></td>";
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


$ro->cashCollection_mmc($year."-".$month."-".$day,"Pharmacy Collection");

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";

$pharmacy = $ro->cashCollection_mmc_total();
echo "<tr>";
echo "<Td>&nbsp;Total Pharmacy:</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;".number_format($pharmacy,2)."</tD>";
echo "<tD>&nbsp;<b>".number_format($pharmacy,2)."</b></tD>";
echo "</tr>";




echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";


$hospPharmacy = ($hospital + $pharmacy);

$hospitalCollection = ($hospPharmacy + $ro->doubleSelectNow("cashCollection","amount","date",$year."-".$month."-".$day,"type","Cash_Inpatient"));
echo "<tr>";
echo "<Td>&nbsp;<b>TOTAL CASH RECEIPTS</b></td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format(( $ro->doubleSelectNow("cashCollection","amount","date",$year."-".$month."-".$day,"type","Cash_Inpatient") + $hospPharmacy),2)."</b></tD>";
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


$ro->cashCollection_mmc($year."-".$month."-".$day,"Disbursement");

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";

$disbursement = $ro->cashCollection_mmc_total();
echo "<tr>";
echo "<Td>&nbsp;<b>TOTAL DISBURSEMENT</b>:</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;".number_format($ro->cashCollection_mmc_total(),2)."</tD>";
echo "<tD>&nbsp;<b>".number_format($ro->cashCollection_mmc_total(),2)."</b></tD>";
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

echo "</table>";

?>

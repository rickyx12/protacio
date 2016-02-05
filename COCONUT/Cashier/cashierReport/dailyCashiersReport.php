<?php
include("../../../myDatabase3.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$shift = $_GET['shift'];
$username = "sion";

$ro = new database3();

$date = $year."-".$month."-".$day;

echo "<style type='text/css'>
.txt {
	font-size:13px;
}
</style>";

echo "<center>
<Br>
<font><a href='http://".$ro->getMyUrl()."/COCONUT/Cashier/cashierReport/attributes_handler.php?date=$date&shift=$shift' style='text-decoration:none;'>Revenue Report</a></font>
<br>
$date
<br><Br>";
echo "<table border=0 width='50%' cellspacing=0>";
echo "<Tr>";

if($shift == "all") {
echo "<th>Shift</th>";
}else { }

echo "<th>Date</th>";
echo "<th>Cash/Check</th>";
echo "<th>OR#</th>";
echo "<th>Patient Name</th>";
echo "<th>Amount</th>";
echo "<th>Type</th>";
echo "</tr>";
$ro->dailyCashiersReport_ipd($shift,$date,$username);
$ro->dailyCashiersReport_opd($shift,$date,$username);
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>TOTAL</font></td>";
echo "<td>&nbsp;<font size=2>".number_format($ro->dailyCashiersReport_opd_total() + $ro->dailyCashiersReport_ipd_total(),2)."</font></td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
echo "</table>";
echo "<br><br><br>";

//STATISTIC TABLE

if($shift == "all") {

echo "<table border=0>";

echo "<Tr>";
echo "<th><font class='txt'>OPD</font></th>";
echo "<th>&nbsp;</th>";
echo "<th width='50%'>&nbsp;</th>";
echo "<th><font class='txt'>IPD</font></th>";
echo "<th>&nbsp;</th>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='txt' color=red>Shift 1</font></td>";
echo "<td>&nbsp;</td>";
echo "<td width='50%'>&nbsp;</td>";
echo "<td><font class='txt' color=red>Shift 1</font></td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
if( $ro->dailyCashiersReport_opd_shift1_cash != "" ) {
echo "<td><font class='txt'>Cash</font></td><td><font class='txt'>".number_format($ro->dailyCashiersReport_opd_shift1_cash,2)."</font></td>";
}else {
echo "<td><font class='txt'>Cash</font></td><td><font class='txt'></font></td>";
}
echo "<td width='50%'>&nbsp;</td>";
echo "<td><font class='txt'>Cash</font></td>";
if( $ro->dailyCashierReport_ipd_shift1_cash != "" ) {
echo "<td><font class='txt'>".number_format($ro->dailyCashierReport_ipd_shift1_cash,2)."</font></td>";
}else {
echo "<td><font class='txt'></font></td>";
}
echo "</tr>";


echo "<tr>";
if($ro->dailyCashiersReport_opd_shift1_creditCard != "") {
echo "<td><font class='txt'>Credit Card</font></td><td><font class='txt'>".number_format($ro->dailyCashiersReport_opd_shift1_creditCard,2)."</font></td>";
}else {
echo "<td><font class='txt'>Credit Card</font></td><td><font class='txt'></font></td>";
}
echo "<td width='50%'>&nbsp;</td>";
echo "<td><font class='txt'>Credit Card</font></td>";
if($ro->dailyCashierReport_ipd_shift1_creditCard != "") {
echo "<td><font class='txt'>".number_format($ro->dailyCashierReport_ipd_shift1_creditCard,2)."</font></td>";
}else {
echo "<td><font class='txt'></font></td>";
}
echo "</tr>";

echo "<tr>";
echo "<td><font class='txt' color=red>Shift 2</font></td>";
echo "<Td>&nbsp;</td>";
echo "<td width='50%'>&nbsp;</td>";
echo "<td><font class='txt' color=red>Shift 2</font></td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
if($ro->dailyCashiersReport_opd_shift2_cash != "") {
echo "<td><font class='txt'>Cash</font></td><td><font class='txt'>".number_format($ro->dailyCashiersReport_opd_shift2_cash,2)."</font></td>";
}else {
echo "<td><font class='txt'>Cash</font></td><td><font class='txt'></font></td>";
}
echo "<td width='50%'>&nbsp;</td>";
echo "<td><font class='txt'>Cash</font></td>";
if($ro->dailyCashierReport_ipd_shift2_cash != "") {
echo "<td><font class='txt'>".number_format($ro->dailyCashierReport_ipd_shift2_cash,2)."</font></td>";
}else {
echo "<td><font class='txt'></font></td>";
}
echo "</tr>";

echo "<tr>";
if($ro->dailyCashiersReport_opd_shift2_creditCard != "") {
echo "<td><font class='txt'>Credit Card</font></td><td><font class='txt'>".number_format($ro->dailyCashiersReport_opd_shift2_creditCard,2)."</font></td>";
}else {
echo "<td><font class='txt'>Credit Card</font></td><td></td>";
}
echo "<td width='50%'>&nbsp;</td>";
echo "<td><font class='txt'>Credit Card</font></td>";
if($ro->dailyCashierReport_ipd_shift2_creditCard != "") {
echo "<td><font class='txt'>".number_format($ro->dailyCashierReport_ipd_shift2_creditCard,2)."</font></td>";
}else {
echo "<td><font class='txt'></font></td><td></td>";
}
echo "</tr>";

echo "<tr>";
echo "<td><font class='txt' color=red>Shift 3</font></td>";
echo "<td>&nbsp;</td>";
echo "<td width='50%'>&nbsp;</td>";
echo "<td><font class='txt' color=red>Shift 3</font></td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
if($ro->dailyCashiersReport_opd_shift3_cash != "") {
echo "<td><font class='txt'>Cash</font></td><td><font class='txt'>".number_format($ro->dailyCashiersReport_opd_shift3_cash,2)."</font></td>";
}else {
echo "<td><font class='txt'>Cash</font></td><td><font class='txt'></font></td>";
}
echo "<td width='50%'>&nbsp;</td>";
echo "<td><font class='txt'>Cash</font></td>";
if($ro->dailyCashierReport_ipd_shift3_cash != "") {
echo "<td><font class='txt'>".$ro->dailyCashierReport_ipd_shift3_cash."</font></td>";
}else {
echo "<td><font class='txt'></font></td>";
}
echo "</tr>";

echo "<tr>";
if($ro->dailyCashiersReport_opd_shift3_creditCard != "") {
echo "<Td><font class='txt'>Credit Card</font></td><td><font class='txt'>".$ro->dailyCashiersReport_opd_shift3_creditCard."</font></td>";
}else {
echo "<Td><font class='txt'>Credit Card</font></td><td><font class='txt'></font></td>";
}
echo "<td width='50%'>&nbsp;</td>";
echo "<td><font class='txt'>Credit Card</font></td>";
if($ro->dailyCashierReport_ipd_shift3_creditCard != "") {
echo "<td><font class='txt'>".$ro->dailyCashierReport_ipd_shift3_creditCard."</font></td>";
}else {
echo "<td><font class='txt'></font></td>";
}
echo "</tr>";

echo "<tr>";
echo "<td><font class='txt' color=red>Total</font></td>";
echo "<td>&nbsp;</td>";
echo "<td width='50%'>&nbsp;</td>";
echo "<td><font class='txt' color=red>Total</font></td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$opdCash = ( $ro->dailyCashiersReport_opd_shift1_cash + $ro->dailyCashiersReport_opd_shift2_cash + $ro->dailyCashiersReport_opd_shift3_cash );
$opdCr = ( $ro->dailyCashiersReport_opd_shift1_creditCard + $ro->dailyCashiersReport_opd_shift2_creditCard + $ro->dailyCashiersReport_opd_shift3_creditCard );
$ipdCash = ( $ro->dailyCashierReport_ipd_shift1_cash + $ro->dailyCashierReport_ipd_shift2_cash + $ro->dailyCashierReport_ipd_shift3_cash );
$ipdCr = ( $ro->dailyCashierReport_ipd_shift1_creditCard + $ro->dailyCashierReport_ipd_shift2_creditCard + $ro->dailyCashierReport_ipd_shift3_creditCard );

echo "<tr>";
if($opdCash != "") {
echo "<td><font class='txt'>Cash</font></td><td><font class='txt'>".number_format($opdCash,2)."</font></td>";
}else {
echo "<td><font class='txt'>Cash</font></td><td><font class='txt'></font></td>";
}
echo "<td width='50%'>&nbsp;</td>";
echo "<td><font class='txt'>Cash</font></td>";
if($ipdCash != "") {
echo "<td><font class='txt'>".number_format($ipdCash,2)."</font></td>";
}else {
echo "<td><font class='txt'></font></td>";
}
echo "</tr>";

echo "<tr>";
if($opdCr != "") {
echo "<Td><font class='txt'>Credit Card</font></td><td><font class='txt'>".number_format($opdCr,2)."</font></td>";
}else {
echo "<Td><font class='txt'>Credit Card</font></td><td><font class='txt'></font></td>";
}
echo "<td width='50%'>&nbsp;</td>";
echo "<td><font class='txt'>Credit Card</font></td>";
if($ipdCr != "") {
echo "<td><font class='txt'>".number_format($ipdCr)."</font></td>";
}else {
echo "<td><font class='txt'></font></td>";
}
echo "</tr>";


echo "</table>";
}else { 
$ro->getDailyCashiersAttribute($shift,$date);
}

?>

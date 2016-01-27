<?php
include("../../../myDatabase2.php");
//include("../../CORE/core2.php");

$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$fromTime_hour = $_GET['fromTime_hour'];
$fromTime_minutes = $_GET['fromTime_minutes'];
$fromTime_seconds = $_GET['fromTime_seconds'];
$toTime_hour = $_GET['toTime_hour'];
$toTime_minutes = $_GET['toTime_minutes'];
$toTime_seconds = $_GET['toTime_seconds'];
$username = $_GET['username'];
$status = $_GET['status'];
$reportName = $_GET['reportName'];
$cutoff = $_GET['cutoff'];


$ro = new database2();
//$c2 = new core2();


echo "<font size=3>$reportName Report</font>";
echo "<br><font size=2>$month $day, $year</font>";
echo "<br><font size=2>$fromTime_hour:$fromTime_minutes:$fromTime_seconds - $toTime_hour:$toTime_minutes:$toTime_seconds</font>";
echo "<table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;Name&nbsp;</th>";
echo "<th>&nbsp;Description&nbsp;</th>";
echo "<th>&nbsp;Price&nbsp;</th>";
//echo "<th>&nbsp;QTY&nbsp;</th>";
//echo "<th>&nbsp;Disc&nbsp;</th>";
echo "<th>&nbsp;Total&nbsp;</th>";
//echo "<th>&nbsp;Balance&nbsp;</th>";
echo "<th>&nbsp;Paid&nbsp;</th>";
echo "<th>&nbsp;Post By&nbsp;</th>";
echo "<th>&nbsp;Hospital Bill&nbsp;</th>";
echo "<th>&nbsp;Professional Fee&nbsp;</th>";
echo "<th>&nbsp;Attending&nbsp;</th>";
echo "<th>&nbsp;Admitting&nbsp;</th>";
echo "</tr>";

$ro->getPartialReport($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$status);


echo "<tr>";
echo "<tD><centeR><b>TOTAL</b></centeR></tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format(($ro->getPartialReport_hb() + $ro->getPartialReport_pf()) + $ro->getPartialReport_admitting(),2)."</b></tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format($ro->getPartialReport_hb(),2)."</b></tD>";
echo "<tD>&nbsp;<b>".number_format($ro->getPartialReport_pf(),2)."</b></tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format($ro->getPartialReport_admitting(),2)."</b></tD>";
echo "</tr>";

echo "<tr>";
//echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";

echo "<tr>";
//echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";



$ro->getCashierReport($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$status);


$ro->getCashierReportBalance($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$status);

echo "<tr>";
echo "<tD><center><b><font size=4>Total</font></b></tD>";
//echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format( $ro->collection_salesPaid() + $ro->balance_salesPaid() ,2)."</b></tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format( $ro->collection_salesPaid() + $ro->balance_salesPaid() ,2)."</b></tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";

$opdCollection = ( $ro->collection_salesPaid() + $ro->balance_salesPaid() );


//$ro->getPartialReport($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$status);

/*
echo "<tr>";
echo "<tD><center><b>TOTAL</b></center></tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format($ro->partial(),2)."</b></tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";
*/
echo "<tr>";
//echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";

$ro->getOthersPartialReport($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$status);

echo "<tr>";
//echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "</tr>";

$ro->getBilledPx();

echo "<tr>";
echo "<tD>&nbsp;<b>Grand Total</b></tD>";
//echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format( (($ro->getPartialReport_hb() + $ro->getPartialReport_pf()) + $ro->getPartialReport_admitting()) + $opdCollection,2)."</b>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format(($ro->getPartialReport_hb() + $opdCollection ),2)."</b>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format($ro->getPartialReport_pf(),2)."</b>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format($ro->getPartialReport_admitting(),2)."</b></tD>";
echo "</tr>";

echo "<Tr>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "</tr>";


echo "<Tr>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "</tr>";



echo "<Tr>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "</tr>";


echo "<Tr>";
echo "<Td>&nbsp;<b>EXPENSES</b></td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "</tr>";

$ro->showExpenses($month,$day,$year,$username);


echo "<Tr>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "</tr>";


echo "<Tr>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "</tr>";


//$superTotal = ( ($ro->getPartialReport_hb() + $ro->getPartialReport_pf() + $ro->getPartialReport_admitting()) + $opdCollection );

$superTotal = ( ($ro->getPartialReport_hb() + $opdCollection) );
$superTotal1 = ( $superTotal - $ro->showExpenses_total() );

echo "<Tr>";
echo "<Td>&nbsp;<b>GRAND TOTAL</b></td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;<b>".number_format($superTotal1,2)."</b></td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "</tr>";


echo "</table>";
echo "<br>";
/*
echo "<font size=3>Total Sales</font>&nbsp;".number_format($ro->collection_salesTotal() + $ro->balance_salesTotal() ,2);
echo "<br><font size=3>Total Balance</font>&nbsp;".number_format($ro->collection_salesUnpaid() + $ro->balance_salesUnpaid() + $ro->partial(),2);
echo "<br><Font size=3>Total Paid</font>&nbsp;".number_format($ro->collection_salesPaid() + $ro->balance_salesPaid() + $ro->partial(),2);
echo "<br><Br><Font size=3><b>Cash</b></font>&nbsp;".number_format($ro->collection_cash() + $ro->balance_salesPaid() + $ro->partial(),2);
echo "<br><Font size=3><b>Credit Card</b> </font>&nbsp;".number_format($ro->collection_creditCard() + $ro->balance_salesPaid(),2);
*/

?>

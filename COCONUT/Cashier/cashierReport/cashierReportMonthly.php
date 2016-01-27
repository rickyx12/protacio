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

?>

<script type="text/javascript">
function printF(printData)
{
	var a = window.open ('',  '',"status=1,scrollbars=1, width=auto,height=auto");
	a.document.write(document.getElementById(printData).innerHTML.replace(/<a\/?[^>]+>/gi, ''));
	a.document.close();
	a.focus();
	a.print();
	a.close();
}
</script>
<a href='#' onClick="printF('printData')" style="text-decoration:none;"><?php echo $ro->coconutImages("printer.jpeg") ?> <font color=red>Print</font></a><Br><Br>
<div id="printData">
<?
echo "<font size=3>Monthly Collection Report</font>";
echo "<br><font size=2>$date1 - $date2</font>";
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

$ro->getPartialReport_monthly($date1,$date2);


echo "<tr>";
echo "<tD><centeR><b>TOTAL</b></centeR></tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format(($ro->getPartialReport_hb_monthly() + $ro->getPartialReport_pf_monthly()) + $ro->getPartialReport_admitting_monthly(),2)."</b></tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format($ro->getPartialReport_hb_monthly(),2)."</b></tD>";
echo "<tD>&nbsp;<b>".number_format($ro->getPartialReport_pf_monthly(),2)."</b></tD>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
//echo "<tD>&nbsp;<a href='http://".$ro->getMyUrl()."/COCONUT/Cashier/cashierReport/receiptTypeReport.php?date=$year-$month-$day&receiptType=medicine&username=$username&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds' target='_blank'><font size=2><b>MEDICINE:</b></font>&nbsp;<font size=3>".number_format($ro->getPartialReport_medicine(),2)."</font></a></tD>";
//echo "<tD>&nbsp;<a href='http://".$ro->getMyUrl()."/COCONUT/Cashier/cashierReport/receiptTypeReport.php?date=$year-$month-$day&receiptType=hospital&username=$username&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds' target='_blank'><font size=2><b>HOSPITAL:</b></font><font size=3>".number_format($ro->getPartialReport_hospital(),2)."</font></a></tD>";
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



$ro->getCashierReport_monthly($date1,$date2);

echo "<tr>";
echo "<tD><center><b><font size=4>Total</font></b></tD>";
//echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format( $ro->collection_salesPaid_monthly(),2)."</b></tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format( $ro->collection_salesPaid_monthly(),2)."</b></tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<font size=2><b>MEDICINE:&nbsp;</b></font>".number_format($ro->collection_medicine_monthly(),2)."</tD>";
echo "<tD>&nbsp;<font size=2><b>HOSPITAL:&nbsp;</b></font>".number_format($ro->collection_hospital_monthly(),2)."</tD>";
echo "</tr>";

$opdCollection = ( $ro->collection_salesPaid_monthly());


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

$ro->getOthersPartialReport_monthly($date1,$date2);

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

//$ro->getBilledPx();

echo "<tr>";
echo "<tD>&nbsp;<b>Grand Total</b></tD>";
//echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format( (($ro->getPartialReport_hb_monthly() + $ro->getPartialReport_pf_monthly()) + $ro->getPartialReport_admitting_monthly()) + $opdCollection + $ro->othersPartial_monthly(),2)."</b>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format(($ro->getPartialReport_hb_monthly() + $opdCollection + $ro->othersPartial_monthly() ),2)."</b>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format($ro->getPartialReport_pf_monthly(),2)."</b>&nbsp;</tD>";
echo "<tD>&nbsp;s</tD>";
echo "<tD>&nbsp;<b>".number_format($ro->getPartialReport_admitting_monthly(),2)."</b></tD>";
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

$ro->showExpenses_monthly($date1,$date2);
$ro->showRefunds_monthly($date1,$date2);

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

$superTotal = ( ($ro->getPartialReport_hb_monthly() + $opdCollection) + $ro->othersPartial_monthly() );
$superTotal1 = ( $superTotal - ($ro->showExpenses_total_monthly() + $ro->totalRefunds_monthly()) );

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
</div>

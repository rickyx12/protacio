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
$shift = $_GET['shift'];
$module = $_GET['module'];


$ro = new database2();
//$c2 = new core2();

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
<?php

if($shift=='-Select Shift-'){
echo "<div align='left'><font face='arial' size='5' color='red'>Please select shift! Try again!</font></div>";
echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=reportShift.php?module=$module&username=$username&reportName=$reportName&status=$status'>";
}
else {

echo "<font size=3>$reportName Report</font>";
echo "<br><font size=2>$month $day, $year</font>";
echo "<br><font size=2>$fromTime_hour:$fromTime_minutes:$fromTime_seconds - $toTime_hour:$toTime_minutes:$toTime_seconds</font>";
$ro->coconutFormStart("get","asignShift.php");
echo "<br>";
echo "Shift:&nbsp;";
$ro->coconutComboBoxStart_short("shift1");
echo "<option value='$shift' selected='selected'>$shift</option>";
echo "<option value='1'>1</option>";
echo "<option value='2'>2</option>";
echo "<option value='3'>3</option>";
$ro->coconutComboBoxStop();
echo "<table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;</th>";
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
echo "<th>&nbsp;Balance&nbsp;</th>";
echo "</tr>";

$ro->getPartialReport($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$status,$cutoff,$shift);


echo "<tr>";
echo "<td>&nbsp;</td>";
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
echo "<td>&nbsp;</td>";
//echo "<tD>&nbsp;<a href='http://".$ro->getMyUrl()."/COCONUT/Cashier/cashierReport/receiptTypeReport.php?date=$year-$month-$day&receiptType=medicine&username=$username&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds' target='_blank'><font size=2><b>MEDICINE:</b></font>&nbsp;<font size=3>".number_format($ro->getPartialReport_medicine(),2)."</font></a></tD>";
//echo "<tD>&nbsp;<a href='http://".$ro->getMyUrl()."/COCONUT/Cashier/cashierReport/receiptTypeReport.php?date=$year-$month-$day&receiptType=hospital&username=$username&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds' target='_blank'><font size=2><b>HOSPITAL:</b></font><font size=3>".number_format($ro->getPartialReport_hospital(),2)."</font></a></tD>";
echo "</tr>";

echo "<tr>";
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



$ro->getCashierReport($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$status,$shift);


$ro->getCashierReportBalance($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$status,$shift);

echo "<tr>";
echo "<tD>&nbsp;</tD>";
echo "<tD><center><b><font size=4>Total</font></b></tD>";
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

echo "<tr>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<b>Grand Total</b></tD>";
//echo "<tD>&nbsp;</tD>";
//echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format( (($ro->getPartialReport_hb() + $ro->getPartialReport_pf()) + $ro->getPartialReport_admitting()) + $opdCollection + $ro->othersPartial(),2)."</b>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format(($ro->getPartialReport_hb() + $opdCollection + $ro->othersPartial() ),2)."</b>&nbsp;</tD>";
echo "<tD>&nbsp;<b>".number_format($ro->getPartialReport_pf(),2)."</b>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
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
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;<b>EXPENSES</b></td>";
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
//$ro->showRefunds($year."-".$month."-".$day);

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

$superTotal = ( ($ro->getPartialReport_hb() + $opdCollection) + $ro->othersPartial() );
$superTotal1 = ( $superTotal - ($ro->showExpenses_total() + $ro->totalRefunds()) );

echo "<Tr>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;<b>GRAND TOTAL</b></td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;<b>".number_format($superTotal1,2)."</b></td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "</tr>";


echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutFormStop();
echo "<br>";
/*
echo "<font size=3>Total Sales</font>&nbsp;".number_format($ro->collection_salesTotal() + $ro->balance_salesTotal() ,2);
echo "<br><font size=3>Total Balance</font>&nbsp;".number_format($ro->collection_salesUnpaid() + $ro->balance_salesUnpaid() + $ro->partial(),2);
echo "<br><Font size=3>Total Paid</font>&nbsp;".number_format($ro->collection_salesPaid() + $ro->balance_salesPaid() + $ro->partial(),2);
echo "<br><Br><Font size=3><b>Cash</b></font>&nbsp;".number_format($ro->collection_cash() + $ro->balance_salesPaid() + $ro->partial(),2);
echo "<br><Font size=3><b>Credit Card</b> </font>&nbsp;".number_format($ro->collection_creditCard() + $ro->balance_salesPaid(),2);
*/

}

?>
</div>

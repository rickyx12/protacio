<?php
include($_SERVER['DOCUMENT_ROOT']."/myDatabase2.php");
$title = $_GET['title'];
$date = $_GET['date'];
$date1 = $_GET['date1'];

$ro = new database2();

$creditCard = $ro->transactionSummary_opd_department_debit_paid($title,"amountPaidFromCreditCard",$date,$date1);
$cash = $ro->transactionSummary_opd_department_debit_paid($title,"cashPaid",$date,$date1);
$hmo = $ro->transactionSummary_opd_department_debit_covered($title,"HMO",$date,$date1);
//$company = $ro->transactionSummary_opd_department_debit_covered($title,"COMPANY",$date,$date1);
$personal = $ro->transactionSummary_opd_department_debit_personalBalance($title,$date,$date1);
$discount = $ro->transactionSummary_opd_department_debit_discount($title,$date,$date1);

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";



echo "<center>";
echo "<font size=4 color=red>$title</font>";
echo "<br>";
echo "<table border=1 cellspacing=0>";
echo "<Tr>";
echo "<Th>OPD</th>";
echo "<th>Amount</th>";
echo "</tr>";
echo "<tr>";

if( $creditCard > 0 ) {
echo "<td>&nbsp;<a href='/COCONUT/billing/transactionSummary_creditCard.php?title=$title&date=$date&date1=$date1' style='text-decoration:none; color:black;' target='rightFrame' ><b>Credit Card</b></a></td>";
echo "<td>&nbsp;".number_format($creditCard,2)."&nbsp;</td>";
echo "</tr>";
}else {
echo "<td>&nbsp;<b>Credit Card</b></td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}


if( $cash > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<a href='transactionSummary_patient.php?cols=cashUnpaid&date=$date&date1=$date1&title=$title' target='rightFrame'><b>Cash</b></a></td>";
echo "<td>&nbsp;<a href='transactionSummary_patient.php?cols=cashUnpaid&date=$date&date1=$date1&title=$title' target='rightFrame' >".number_format($cash,2)."&nbsp;</td>";
echo "</tr>";
}else {
echo "<tr>";
echo "<td>&nbsp;<b>Cash</b></td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}


if( $hmo > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<a href='/COCONUT/billing/transactionSummary_patient.php?cols=hmo&date=$date&date1=$date1&title=$title' style='text-decoration:none; color:black;' target='rightFrame'><b>A/R HMO</b></a></td>";
echo "<td>&nbsp;".number_format($hmo,2)."&nbsp;</td>";
echo "</tr>";
}else {
echo "<tr>";
echo "<td>&nbsp;<b>A/R HMO</b></td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}

/*
if( $company > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<b>A/R Company</b></td>";
echo "<td>&nbsp;".number_format($company,2)."&nbsp;</td>";
echo "</tr>";
}else {
echo "<tr>";
echo "<td>&nbsp;<b>A/R Company</b></td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

}
*/

if( $personal > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<a href='/COCONUT/billing/balancePatient.php?title=$title&date=$date&date1=$date1' style='text-decoration:none; color:black;' target='rightFrame'><b>A/R-OPD(PERSONAL) </b></a>&nbsp;</td>";
echo "<td>&nbsp;".$personal."</td>";
echo "</tr>";
}else {
echo "<tr>";
echo "<td>&nbsp;<b>A/R-OPD(PERSONAL) </b></td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}


if( $discount > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<a href='/COCONUT/billing/transactionSummary_discPx.php?title=$title&date=$date&date1=$date1' style='text-decoration:none; color:black;' target='rightFrame'><b>Revenue Discount</b></a></td>";
echo "<td>&nbsp;".number_format($discount,2)."&nbsp;</td>";
echo "</tr>";
}else {
echo "<tr>";
echo "<td>&nbsp;<b>Revenue Discount </b></td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}

//$total = ($creditCard + $cash + $hmo + $company + $personal + $discount);
$total = ($creditCard + $cash + $hmo + $personal + $discount);


if( $total > 0 ) {
echo "<tr>";
echo "<td>&nbsp;<b></b></td>";
echo "<Td>&nbsp;".number_format($total,2)."&nbsp;</td>";
echo "</tr>";
}else {
echo "<tr>";
echo "<td>&nbsp;<b></b></td>";
echo "<Td>&nbsp;</td>";
echo "</tr>";
}
echo "</table>";

?>

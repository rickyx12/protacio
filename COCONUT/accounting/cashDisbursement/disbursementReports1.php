<?php
include("../../../myDatabase2.php");
$fromMonth = $_POST['fromMonth'];
$fromDay = $_POST['fromDay'];
$fromYear = $_POST['fromYear'];
$toMonth = $_POST['toMonth'];
$toDay = $_POST['toDay'];
$toYear = $_POST['toYear'];



$ro = new database2();

$group_debit="";
$group_credit="";
$individual_debit="";
$individual_credit="";

$date = $fromYear."-".$fromMonth."-".$fromDay;
$date1 = $toYear."-".$toMonth."-".$toDay;

echo "<style>

.matrix {
font-family:courier;
}

tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";


echo "<font class='matrix' size=2>from $date to $date1</font>";
echo "<table border=0 cellspacing=0 cellpadding=1>";
echo "<tr>";
echo "<th class='matrix'><font size=2>Encoded</font></th>";
echo "<th class='matrix'><font size=2>Acct.No</font></th>";
echo "<th class='matrix'><font size=2>Account Head-Paid To</font></th>";
echo "<th class='matrix'><font size=2>Narration</font></th>";
echo "<th class='matrix'><font size=2>Chq/LPO/<br>Invoice No</font></th>";
echo "<th class='matrix'><font size=2>Dated</font></th>";
echo "<th class='matrix'><font size=2>Debit</font></th>";
echo "<th class='matrix'><font size=2>Credit</font></th>";
echo "</tr>";
$ro->getDisbursementReportForGroup($date,$date1);
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
$ro->getDisbursementReportForIndividual($date,$date1);
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$debitTotalz = ( $ro->getDisbursementReport_group_debitTotal() + $ro->getDisbursementReport_individual_debit() );
$creditTotalz = ( $ro->getDisbursementReport_group_creditTotal() + $ro->getDisbursementReport_individual_credit() );

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2 class='matrix'><b>".number_format($debitTotalz,2)."</b></font></td>";
echo "<td>&nbsp;<font size=2 class='matrix'><b>".number_format($creditTotalz,2)."</b></font></td>";
echo "</tr>";
echo "</table>";

?>

<?php
include("../../../myDatabase.php");
$titles = $_GET['titles'];
$fromMonth = $_GET['fromMonth'];
$fromDay = $_GET['fromDay'];
$fromYear = $_GET['fromYear'];
$toMonth = $_GET['toMonth'];
$toDay = $_GET['toDay'];
$toYear = $_GET['toYear'];
$ro = new database();

$fromDate = $fromYear."-".$fromMonth."-".$fromDay;
$toDate = $toYear."-".$toMonth."-".$toDay;

echo "<Center>";
echo "<font size=6>".$ro->getReportInformation("hmoSOA_name")."</font><br>";
echo "<font size=3>".$ro->getReportInformation("hmoSOA_address")."</font><br>";

//echo "<br><font size=4><b>$department EXAMINATION CENSUS ($type)</b></font><Br>";

echo "<font size=2>( $fromMonth-$fromDay-$fromYear to $toMonth-$toDay-$toYear )</font><br><font size=2>$titles Per Examination</font><br>";

echo "<center>
<table border=1 cellpadding=0 cellspacing=0>
<tr>
<th>&nbsp;Examination&nbsp;</th>
<th>&nbsp;IPD</th>
<th>&nbsp;OPD</th>
<th>&nbsp;<b>TOTAL</b>&nbsp;</th>
";


echo "
</tr>
<tr>";
$ro->listExaminationAsRow($titles,$fromDate,$toDate);
echo "</tr>

</table>

";


?>

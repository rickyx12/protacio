<?php
include("../../payrollDatabase.php");
$fromYear = $_POST['fromYear'];
$fromMonth = $_POST['fromMonth'];
$fromDay = $_POST['fromDay'];
$toYear = $_POST['toYear'];
$toMonth = $_POST['toMonth'];
$toDay = $_POST['toDay'];

$ro = new payroll();

$from = $fromYear."-".$fromMonth."-".$fromDay;
$to = $toYear."-".$toMonth."-".$toDay;


echo "<center><font size=6> Payroll  </font></center>";
echo "<center><font size=3>( $fromYear-$fromMonth-$fromDay to $toYear-$toMonth-$toDay )</font></center>";
echo "<br>";
echo "<center>";
echo "<table border=1 cellspacing=0 cellpadding=0>";
echo "<Tr>";
echo "<th> Employee </th>";
echo "<th> SSS </th>";
echo "<th> PhilHealth </th>";
echo "<th> Pag-ibig </th>";
echo "<th> W/ Tax </th>";
echo "<Th> Gross </th>";
echo "<th> Deduction </th>";
echo "<th> Net </th>";
echo "</tr>";
$ro->payrollMonthly($from,$to);
echo "</table>";

?>

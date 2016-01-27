<?php
include("../../../payrollDatabase.php");

$fromYear = $_POST['fromYear'];
$fromMonth = $_POST['fromMonth'];
$fromDay = $_POST['fromDay'];

$toYear = $_POST['toYear'];
$toMonth = $_POST['toMonth'];
$toDay = $_POST['toDay'];

$ro = new payroll();

$from = $fromYear."-".$fromMonth."-".$fromDay;
$to = $toYear."-".$toMonth."-".$toDay;

echo "<center><font size=6>Pag-ibig Monthly</font></center>";
echo "<center><font size=2> ( <b>$fromYear-$fromMonth-$fromDay</b> to <b>$toYear-$toMonth-$toDay</b> ) </font></center>";

echo "<br><br>";

echo "<center>";
echo "<table border=1 cellspacing=0 cellpadding=1>";
echo "<Tr>";
echo "<th> Employee </th>";
echo "<th> SSS </th>";
echo "</tr>";
$ro->monthlyReport("pagibigEmployerShare",$from,$to);
echo "</table>";
echo "</center>";
?>

<?php
include("../../payrollDatabase.php");
$username = $_GET['username'];

$ro = new payroll();


echo "<br><center><font size=5>Pag-Ibig Contribution Table</font></center>";
$ro->pagibigContribution($username);

?>

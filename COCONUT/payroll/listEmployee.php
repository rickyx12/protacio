<?php
include("../../payrollDatabase.php");
$username = $_GET['username'];
$ro = new payroll();


echo "<table cellspacing=0 cellpadding=1 border=1>";
echo "<tr>";
echo "<th>Name</th>";
echo "</tr>";
$ro->listEmployee($username);
echo "</table>";

?>

<?php
include("../../payrollDatabase.php");
$username = $_GET['username'];

$ro = new payroll();

echo "<center><font size=5>SSS Contribution Table</font>";
$ro->sssContribution($username);


?>

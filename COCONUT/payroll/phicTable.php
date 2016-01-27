<?php
include("../../payrollDatabase.php");
$username = $_GET['username'];
$ro = new payroll();


echo "<br><center><font size=5>PhilHealth Contribution Table</font>";
$ro->phicContribution($username);


?>

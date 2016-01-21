<?php
include("../../payrollDatabase.php");
$employeeID = $_POST['employeeID'];
$username = $_POST['username'];

$ro = new payroll();


echo "<br><Br><br><br>";
$ro->getPayrollList($employeeID,$username);


?>

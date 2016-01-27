<?php
include("../../payrollDatabase.php");
$username = $_GET['username'];

$ro = new payroll();

$ro->withholdingTax($username);

?>

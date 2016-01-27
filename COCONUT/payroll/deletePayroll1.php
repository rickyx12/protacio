<?php
include("../../myDatabase.php");
$payrollNo = $_POST['payrollNo'];
$username = $_POST['username'];
$empID = $_POST['empID'];
$ro = new database();

$ro->editNow("employeePayroll","payrollNo",$payrollNo,"status","DELETED_".$username);
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/payroll/employeeDetails.php?employeeID=$empID&username=$username");

?>

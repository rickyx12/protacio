<?php
include("../../myDatabase.php");
$payrollNo = $_GET['payrollNo'];
$empID = $_GET['empID'];
$username = $_GET['username'];
$ro = new database();

$ro->coconutFormStart("post","/COCONUT/payroll/deletePayroll1.php");
$ro->coconutHidden("payrollNo",$payrollNo);
$ro->coconutHidden("empID",$empID);
$ro->coconutHidden("username",$username);
echo "<br><br><br><br><br><BR>";
$ro->coconutBoxStart_red("500","100");
echo "<br>";

echo "<font color=red> Delete Payroll of</font> <font color='blue'>".$ro->selectNow("registeredUser","completeName","employeeID",$empID)."<font color=red> from ".$ro->selectNow("employeePayroll","payFrom","payrollNo",$payrollNo)." to ".$ro->selectNow("employeePayroll","payTo","payrollNo",$payrollNo)."?? </font>";
echo "<br><br>";
echo "<input type='submit' value='Delete' style='border:1px solid #ff0000;'>";
$ro->coconutBoxStop();
$ro->coconutFormStop();
?>

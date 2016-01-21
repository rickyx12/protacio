<?php
include("../../myDatabase.php");
$employeeID = $_POST['employeeID'];
$position = $_POST['position'];
$salaryBasic = $_POST['salaryBasic'];
$department = $_POST['department'];
$status = $_POST['status'];
$age = $_POST['age'];
$birthdate = $_POST['birthdate'];
$address = $_POST['address'];
$username = $_POST['username'];
$ro = new database();

$ro->editNow("registeredUser","employeeID",$employeeID,"position",$position);
$ro->editNow("registeredUser","employeeID",$employeeID,"salaryBasic",$salaryBasic);
$ro->editNow("registeredUser","employeeID",$employeeID,"department",$department);
$ro->editNow("registeredUser","employeeID",$employeeID,"status",$status);
$ro->editNow("registeredUser","employeeID",$employeeID,"age",$age);
$ro->editNow("registeredUser","employeeID",$employeeID,"birthdate",$birthdate);
$ro->editNow("registeredUser","employeeID",$employeeID,"address",$address);
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/payroll/employeeDetails.php?employeeID=$employeeID&username=$username");
?>

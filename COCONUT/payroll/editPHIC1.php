<?php
include("../../myDatabase.php");
$username = $_POST['username'];
$phicID = $_POST['phicID'];
$salaryBracket = $_POST['salaryBracket'];
$salaryRange1 = $_POST['salaryRange1'];
$salaryRange2 = $_POST['salaryRange2'];
$salaryBase = $_POST['salaryBase'];
$totalMonthlyPremium = $_POST['totalMonthlyPremium'];
$employeeShare = $_POST['employeeShare'];
$employerShare = $_POST['employerShare'];

$ro = new database();


$ro->editNow("contribution_phic","phicID",$phicID,"salaryBracket",$salaryBracket);
$ro->editNow("contribution_phic","phicID",$phicID,"salaryRange1",$salaryRange1);
$ro->editNow("contribution_phic","phicID",$phicID,"salaryRange2",$salaryRange2);
$ro->editNow("contribution_phic","phicID",$phicID,"salaryBase",$salaryBase);
$ro->editNow("contribution_phic","phicID",$phicID,"totalMonthlyPremium",$totalMonthlyPremium);
$ro->editNow("contribution_phic","phicID",$phicID,"employeeShare",$employeeShare);
$ro->editNow("contribution_phic","phicID",$phicID,"employerShare",$employerShare);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/payroll/phicTable.php?username=$username");

?>

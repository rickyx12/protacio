<?php
include("../../payrollDatabase.php");
$employeeID = $_GET['employeeID'];
$salary = $_GET['salary'];
$overtime = $_GET['overtime'];
$holiday = $_GET['holiday'];
$nsd = $_GET['nsd'];
$gross = $_GET['gross'];
$sss = $_GET['sss'];
$philhealth = $_GET['philhealth'];
$pagibig = $_GET['pagibig'];
$wTax = $_GET['wTax'];
$late = $_GET['late'];
$absences = $_GET['absences'];
$totalDeduction = $_GET['totalDeduction'];
$total = $_GET['total'];
$username = $_GET['username'];
$monthType = $_GET['monthType'];
$fromMonth = $_GET['fromMonth'];
$fromDay = $_GET['fromDay'];
$fromYear = $_GET['fromYear'];
$toMonth = $_GET['toMonth'];
$toDay = $_GET['toDay'];
$toYear = $_GET['toYear'];
$sssER = $_GET['sssER'];
$phicEmployerShare = $_GET['phicEmployerShare'];
$hdmfEmployerShare = $_GET['hdmfEmployerShare'];


$ro = new payroll();

$payFrom = $fromMonth."-".$fromDay."-".$fromYear;
$payTo = $toMonth."-".$toDay."-".$toYear;

$ro->insertEmployeePayroll($employeeID,$salary,$overtime,$holiday,$nsd,$late,$absences,$sss,$philhealth,$pagibig,$wTax,$gross,$totalDeduction,$total,$monthType,$payFrom,$payTo,$ro->getSynapseTime(),date("Y-m-d"),$username,$sssER,$phicEmployerShare,$hdmfEmployerShare);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/payroll/employeeDetails.php?employeeID=$employeeID&username=$username");

?>

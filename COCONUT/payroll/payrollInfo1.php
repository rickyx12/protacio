<?php
include("../../myDatabase.php");
$payrollNo = $_POST['payrollNo'];
$salaryBasic = $_POST['salaryBasic'];
$overtime = $_POST['overtime'];
$holiday = $_POST['holiday'];
$nsd = $_POST['nsd'];
$late = $_POST['late'];
$absences = $_POST['absences'];
$sss = $_POST['sss'];
$phic = $_POST['phic'];
$pagibig = $_POST['pagibig'];
$withholdingTax = $_POST['withholdingTax'];
$gross = $_POST['gross'];
$deduction = $_POST['deduction'];
$net = $_POST['net'];
$monthType = $_POST['monthType'];

$fromMonth = $_POST['fromMonth'];
$fromDay = $_POST['fromDay'];
$fromYear = $_POST['fromYear'];
$toMonth = $_POST['toMonth'];
$toDay = $_POST['toDay'];
$toYear = $_POST['toYear'];
$empID = $_POST['empID'];
$username = $_POST['username'];


$sssEmployerShare = $_POST['sssEmployerShare'];
$philhealthEmployerShare = $_POST['philhealthEmployerShare'];
$pagibigEmployerShare = $_POST['pagibigEmployerShare'];

$ro = new database();

$payFrom = $fromMonth."-".$fromDay."-".$fromYear;
$payTo = $toMonth."-".$toDay."-".$toYear;


$ro->editNow("employeePayroll","payrollNo",$payrollNo,"salary",$salaryBasic);
$ro->editNow("employeePayroll","payrollNo",$payrollNo,"overtime",$overtime);
$ro->editNow("employeePayroll","payrollNo",$payrollNo,"holiday",$holiday);
$ro->editNow("employeePayroll","payrollNo",$payrollNo,"nsd",$nsd);
$ro->editNow("employeePayroll","payrollNo",$payrollNo,"late",$late);
$ro->editNow("employeePayroll","payrollNo",$payrollNo,"absences",$absences);
$ro->editNow("employeePayroll","payrollNo",$payrollNo,"sss",$sss);
$ro->editNow("employeePayroll","payrollNo",$payrollNo,"phic",$phic);
$ro->editNow("employeePayroll","payrollNo",$payrollNo,"pagibig",$pagibig);
$ro->editNow("employeePayroll","payrollNo",$payrollNo,"withholdingTax",$withholdingTax);
$ro->editNow("employeePayroll","payrollNo",$payrollNo,"gross",$gross);
$ro->editNow("employeePayroll","payrollNo",$payrollNo,"deduction",$deduction);
$ro->editNow("employeePayroll","payrollNo",$payrollNo,"net",$net);
$ro->editNow("employeePayroll","payrollNo",$payrollNo,"monthType",$monthType);
$ro->editNow("employeePayroll","payrollNo",$payrollNo,"payFrom",$payFrom);
$ro->editNow("employeePayroll","payrollNo",$payrollNo,"payTo",$payTo);
$ro->editNow("employeePayroll","payrollNo",$payrollNo,"sssEmployerShare",$sssEmployerShare);
$ro->editNow("employeePayroll","payrollNo",$payrollNo,"philhealthEmployerShare",$philhealthEmployerShare);
$ro->editNow("employeePayroll","payrollNo",$payrollNo,"pagibigEmployerShare",$pagibigEmployerShare);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/payroll/employeeDetails.php?employeeID=$empID&username=$username");

?>

<?php
include("../../payrollDatabase.php");
$payrollNo = $_GET['payrollNo'];
$empID = $_GET['empID'];
$payroll = new payroll();


$grossPay = ( $payroll->selectNow("employeePayroll","salary","empID",$empID) + $payroll->selectNow("employeePayroll","overtime","empID",$empID) + $payroll->selectNow("employeePayroll","holiday","empID",$empID) + $payroll->selectNow("employeePayroll","nsd","empID",$empID)  );

$totalDeduction = ( $payroll->selectNow("employeePayroll","withholdingTax","empID",$empID) + $payroll->selectNow("employeePayroll","sss","empID",$empID) + $payroll->selectNow("employeePayroll","pagibig","empID",$empID) + $payroll->selectNow("employeePayroll","phic","empID",$empID) );


$misc = ( $payroll->selectNow("employeePayroll","late","empID",$empID) + $payroll->selectNow("employeePayroll","absences","empID",$empID) );

echo "<br><br>";
echo "<font size=3><b>".$payroll->selectNow("reportHeading","information","reportName","hmoSOA_name")."</b></font>";
echo "<br>";
echo "<font size=2><b>Employee's Payslip</b></font>";
echo "<br>";
echo "<font size=2><b>Payroll Period:</b>&nbsp;".$payroll->selectNow("employeePayroll","payFrom","payrollNo",$payrollNo)." - ".$payroll->selectNow("employeePayroll","payTo","payrollNo",$payrollNo)."</font>";

echo "<br><br>";

echo "<font size=3><b>Name:</b>&nbsp;".$payroll->selectNow("registeredUser","completeName","employeeID",$empID)."</font>";
echo "<br><br>";

echo "<table border=0 width='40%'>";

echo "<tr>";
echo "<td><font size=3>Basic Salary</font></td>";
echo "<td align='right'><font size=3>".number_format($payroll->selectNow("employeePayroll","salary","empID",$empID),2)."</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size=3>Overtime</font></td>";
echo "<td align='right'><font size=3>".number_format($payroll->selectNow("employeePayroll","overtime","empID",$empID),2)."</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size=3>Holiday</font></td>";
echo "<td align='right'><font size=3>".number_format($payroll->selectNow("employeePayroll","holiday","empID",$empID),2)."</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size=3>NSD</font></td>";
echo "<td align='right'><font size=3>".number_format($payroll->selectNow("employeePayroll","nsd","empID",$empID),2)."</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size=3>Late</font></td>";
echo "<td align='right'><font size=3>".number_format($payroll->selectNow("employeePayroll","late","empID",$empID),2)."</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size=3>Absences</font></td>";
echo "<td align='right'><font size=3>".number_format($payroll->selectNow("employeePayroll","absences","empID",$empID),2)."</font></td>";
echo "</tr>";

echo "</table>";
echo "-------------------------------------------------------";
echo "<table border='0' width='40%'>";
echo "<tr>";
echo "<td><font size=3><b>Gross Pay</b></font></td>";
echo "<td align='right'>".number_format(($grossPay - $misc),2)."</tD>";
echo "</tr>";
echo "</table>";
echo "<br>";
echo "<font size=3><b>Deduction</b></font>";
echo "<table border='0' width='40%'>";

echo "<tr>";
echo "<td><font size=3>W/ Tax</font></tD>";
echo "<td align='right'><font size=3>".number_format($payroll->selectNow("employeePayroll","withholdingTax","empID",$empID),2)."</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size=3>SSS</font></tD>";
echo "<td align='right'><font size=3>".number_format($payroll->selectNow("employeePayroll","sss","empID",$empID),2)."</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size=3>Pag-ibig</font></tD>";
echo "<td align='right'><font size=3>".number_format($payroll->selectNow("employeePayroll","pagibig","empID",$empID),2)."</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size=3>PhilHealth</font></tD>";
echo "<td align='right'><font size=3>".number_format($payroll->selectNow("employeePayroll","phic","empID",$empID),2)."</font></td>";
echo "</tr>";
echo "</table>";
echo "------------------------------------------------------";
echo "<br>";
echo "<table border=0 width='40%'>";
echo "<tr>";
echo "<td><font size=2><b>Total Deduction</b></font></tD>";
echo "<td align='right'><font size=3>".number_format($totalDeduction,2)."</font></tD>";
echo "</tr>";
echo "</table>";


echo "<br><br>";

echo "<table border=0 width='40%'>";
echo "<td><b>Net Pay</b></td>";
echo "<td align='right'>".number_format(($grossPay - $misc) - $totalDeduction,2 )."</tD>";
echo "</table>";


?>

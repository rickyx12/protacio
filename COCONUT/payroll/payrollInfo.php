<?php
include("../../payrollDatabase.php");
$payrollNo = $_GET['payrollNo'];
$empID = $_GET['empID'];
$username = $_GET['username'];


$ro = new payroll();
$ro->coconutDesign();
echo "<br>";
$ro->coconutFormStart("post","/COCONUT/payroll/payrollInfo1.php");
$ro->coconutHidden("payrollNo",$payrollNo);
$ro->coconutHidden("empID",$empID);
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("500","755");
echo "<Br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Salary/Rate</td>";
echo "<td>";
$ro->coconutTextBox("salaryBasic",$ro->selectNow("employeePayroll","salary","payrollNo",$payrollNo));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Overtime</td>";
echo "<td>";
$ro->coconutTextBox("overtime",$ro->selectNow("employeePayroll","overtime","payrollNo",$payrollNo));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Holiday</td>";
echo "<td>";
$ro->coconutTextBox("holiday",$ro->selectNow("employeePayroll","holiday","payrollNo",$payrollNo));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>NSD</td>";
echo "<td>";
$ro->coconutTextBox("nsd",$ro->selectNow("employeePayroll","nsd","payrollNo",$payrollNo));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Late</td>";
echo "<td>";
$ro->coconutTextBox("late",$ro->selectNow("employeePayroll","late","payrollNo",$payrollNo));
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Absences</td>";
echo "<td>";
$ro->coconutTextBox("absences",$ro->selectNow("employeePayroll","absences","payrollNo",$payrollNo));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>SSS</td>";
echo "<td>";
$ro->coconutTextBox("sss",$ro->selectNow("employeePayroll","sss","payrollNo",$payrollNo));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>PhilHealth</td>";
echo "<td>";
$ro->coconutTextBox("phic",$ro->selectNow("employeePayroll","phic","payrollNo",$payrollNo));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Pag-ibig</td>";
echo "<td>";
$ro->coconutTextBox("pagibig",$ro->selectNow("employeePayroll","pagibig","payrollNo",$payrollNo));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>W/ Tax</td>";
echo "<td>";
$ro->coconutTextBox("withholdingTax",$ro->selectNow("employeePayroll","withholdingTax","payrollNo",$payrollNo));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Gross</td>";
echo "<td>";
$ro->coconutTextBox("gross",$ro->selectNow("employeePayroll","gross","payrollNo",$payrollNo));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Deduction</td>";
echo "<td>";
$ro->coconutTextBox("deduction",$ro->selectNow("employeePayroll","deduction","payrollNo",$payrollNo));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Net</td>";
echo "<td>";
$ro->coconutTextBox("net",$ro->selectNow("employeePayroll","net","payrollNo",$payrollNo));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Month Type</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("monthType");
echo "<option value='".$ro->selectNow("employeePayroll","monthType","payrollNo",$payrollNo)."'>".$ro->selectNow("employeePayroll","monthType","payrollNo",$payrollNo)."</option>";
echo "<option value='MONTHLY'>MONTHLY</option>";
echo "<option value='SEMI_MONTHLY'>SEMI_MONTHLY</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td> Pay From </td>";
echo "<td>";
$payFrom = preg_split ("/\-/", $ro->selectNow("employeePayroll","payFrom","payrollNo",$payrollNo) ); 
$ro->coconutComboBoxStart_short("fromMonth");
echo "<option value='".$payFrom[0]."'>".$payFrom[0]."</option>";
echo "<option value='Jan'>Jan</option>";
echo "<option value='Feb'>Feb</option>";
echo "<option value='Mar'>Mar</option>";
echo "<option value='Apr'>Apr</option>";
echo "<option value='May'>May</option>";
echo "<option value='Jun'>Jun</option>";
echo "<option value='Jul'>Jul</option>";
echo "<option value='Aug'>Aug</option>";
echo "<option value='Sep'>Sep</option>";
echo "<option value='Oct'>Oct</option>";
echo "<option value='Nov'>Nov</option>";
echo "<option value='Dec'>Dec</option>";
$ro->coconutComboBoxStop();
echo "-";
$ro->coconutComboBoxStart_short("fromDay");
echo "<option value='".$payFrom[1]."'>".$payFrom[1]."</option>";
for( $x=1;$x<32;$x++ ) {
if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
$ro->coconutComboBoxStop();
echo "-";
$ro->coconutTextBox_short("fromYear",$payFrom[2]);
echo "</td>";
echo "</tr>";



echo "<tr>";
echo "<td> Pay To </td>";
echo "<td>";
$payTo = preg_split ("/\-/", $ro->selectNow("employeePayroll","payTo","payrollNo",$payrollNo) ); 
$ro->coconutComboBoxStart_short("toMonth");
echo "<option value='".$payTo[0]."'>".$payTo[0]."</option>";
echo "<option value='Jan'>Jan</option>";
echo "<option value='Feb'>Feb</option>";
echo "<option value='Mar'>Mar</option>";
echo "<option value='Apr'>Apr</option>";
echo "<option value='May'>May</option>";
echo "<option value='Jun'>Jun</option>";
echo "<option value='Jul'>Jul</option>";
echo "<option value='Aug'>Aug</option>";
echo "<option value='Sep'>Sep</option>";
echo "<option value='Oct'>Oct</option>";
echo "<option value='Nov'>Nov</option>";
echo "<option value='Dec'>Dec</option>";
$ro->coconutComboBoxStop();
echo "-";
$ro->coconutComboBoxStart_short("toDay");
echo "<option value='".$payTo[1]."'>".$payTo[1]."</option>";
for( $x=1;$x<32;$x++ ) {
if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
$ro->coconutComboBoxStop();
echo "-";
$ro->coconutTextBox_short("toYear",$payTo[2]);
echo "</td>";
echo "</tr>";

echo "</table>";
echo "<Br>";
echo "<hr>";
echo "<b> Employer Share </b>";
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<Td>SSS</td>";
echo "<td>".$ro->coconutTextBox_return("sssEmployerShare",$ro->selectNow("employeePayroll","sssEmployerShare","payrollNo",$payrollNo))."</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>PhilHealth</td>";
echo "<td>".$ro->coconutTextBox_return("philhealthEmployerShare",$ro->selectNow("employeePayroll","philhealthEmployerShare","payrollNo",$payrollNo))."</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>Pag-ibig</td>";
echo "<td>".$ro->coconutTextBox_return("pagibigEmployerShare",$ro->selectNow("employeePayroll","pagibigEmployerShare","payrollNo",$payrollNo))."</tD>";
echo "</tr>";

echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();


?>

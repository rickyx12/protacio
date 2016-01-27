<?php
include("../../payrollDatabase.php");
$employeeID = $_GET['employeeID'];
$username = $_GET['username'];
$ro = new payroll();
$ro->coconutDesign();


if(isset($_GET['salary']) && isset($_GET['overtime']) && isset($_GET['holiday']) && isset($_GET['late']) && isset($_GET['absences']) && isset($_GET['wTax']) && isset($_GET['monthType']) && isset($_GET['philhealth']) && isset($_GET['sss']) && isset($_GET['pagibig']) && isset($_GET['nsd']) ) {
$salary = $_GET['salary'];
$overtime = $_GET['overtime'];
$holiday = $_GET['holiday'];
$late = $_GET['late'];
$absences = $_GET['absences'];
$wTax = $_GET['wTax'];
$monthType = $_GET['monthType'];
$nsd = $_GET['nsd'];

$philhealthContribution = $ro->getPhilHealthContribution($salary);
$sssContribution = $ro->getSSSContribution($salary);
$hdmfContribution = $ro->getHDMFContribution($salary);
$gross = ( $salary + $overtime + $holiday + $nsd );
$deduction = ($late + $absences + $philhealthContribution + $sssContribution + $hdmfContribution );
$total = ($gross - $deduction);
$exemptionAmount = $ro->getExemptionAmount($total,$monthType,$ro->selectNow("registeredUser","status","employeeID",$employeeID));
$ro->getPossibleExemption($exemptionAmount,$ro->selectNow("registeredUser","status","employeeID",$employeeID),$monthType);
$withholdingTax =( (($total - $exemptionAmount) * $ro->getPossibleExemption_statusBracket()) + $ro->getPossibleExemption_baseTax() );

$sssEmployerShare = $ro->getSSS_employerContribution($salary);
$phicEmployerShare = $ro->getPhilHealth_employerContribution($salary);
$pagibigEmployerShare = $ro->getHDMF_employerContribution($salary);

}


echo "<div style='border:0px solid #000; height:200px; width:700px; float:left;'>";
echo "<table border=0>";
echo "<tr>";
echo "<td><b>Emp ID#</b>&nbsp;</tD>";
echo "<td>$employeeID</td>";
echo "</tr>";

echo "<Tr>";
echo "<tD><b>Name</b>&nbsp;</tD>";
echo "<td>".$ro->selectNow("registeredUser","completeName","employeeID",$employeeID)."</tD>";
echo "</tr>";

echo "<tr>";
echo "<td><b>Position</b>&nbsp;</td>";
echo "<tD>".$ro->selectNow("registeredUser","position","employeeID",$employeeID)."</td>";
echo "<tD>&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;</tD>";
echo "<Td><b>Department&nbsp;</b>&nbsp;</tD>";
echo "<td>".$ro->selectNow("registeredUser","department","employeeID",$employeeID)."</tD>";
echo "</tr>";


echo "<tr>";
echo "<td><b>Username</b>&nbsp;</td>";
echo "<tD>".$ro->selectNow("registeredUser","username","employeeID",$employeeID)."</td>";
echo "<tD>&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;</tD>";
echo "<Td><b>Module&nbsp;</b>&nbsp;</tD>";
echo "<td>".$ro->selectNow("registeredUser","module","employeeID",$employeeID)."</tD>";
echo "</tr>";


echo "<tr>";
echo "<td><b>Status</b>&nbsp;</td>";
echo "<tD>".$ro->selectNow("registeredUser","status","employeeID",$employeeID)."</td>";
echo "<tD>&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;</tD>";
echo "<Td><b>Salary/Rate&nbsp;</b>&nbsp;</tD>";
echo "<td>".$ro->selectNow("registeredUser","salaryBasic","employeeID",$employeeID)."</tD>";
echo "</tr>";


echo "<tr>";
echo "<td><b>Age</b>&nbsp;</td>";
echo "<tD>".$ro->selectNow("registeredUser","age","employeeID",$employeeID)."</td>";
echo "<tD>&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;</tD>";
echo "<Td><b>BirthDate&nbsp;</b>&nbsp;</tD>";
echo "<td>".$ro->selectNow("registeredUser","birthdate","employeeID",$employeeID)."</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td><b>Address</b>&nbsp;</tD>";
echo "<td>".$ro->selectNow("registeredUser","address","employeeID",$employeeID)."</tD>";
echo "</tr>";
echo "</table>";

echo "<table border=0>";
echo "<tr>";
echo "<td>";
echo "<form method='post' action='/COCONUT/payroll/editInfo.php'>";
$ro->coconutHidden("employeeID",$employeeID);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("completeName",$ro->selectNow("registeredUser","completeName","employeeID",$employeeID));
$ro->coconutHidden("position",$ro->selectNow("registeredUser","position","employeeID",$employeeID));
$ro->coconutHidden("department",$ro->selectNow("registeredUser","department","employeeID",$employeeID));
$ro->coconutHidden("status",$ro->selectNow("registeredUser","status","employeeID",$employeeID));
$ro->coconutHidden("salaryBasic",$ro->selectNow("registeredUser","salaryBasic","employeeID",$employeeID));
$ro->coconutHidden("age",$ro->selectNow("registeredUser","age","employeeID",$employeeID));
$ro->coconutHidden("birthdate",$ro->selectNow("registeredUser","birthdate","employeeID",$employeeID));
$ro->coconutHidden("address",$ro->selectNow("registeredUser","address","employeeID",$employeeID));
echo "<input type='submit' value='Edit Information' style='border:1px solid #ff0000;'>";
echo "</form>";
echo "</td>";
echo "<td>";
echo "<form method='post' action='/COCONUT/payroll/payrollList.php'>";
$ro->coconutHidden("employeeID",$employeeID);
$ro->coconutHidden("username",$username);
echo "<input type='submit' value='View Payroll List' style='border:1px solid #ff0000;' >";
echo "</form>";
echo "</td>";
echo "</tr>";
echo "</table>";

echo "</div>";

echo "<div style='border:0px solid #000; height:200px; width:300px; float:right;'>";
if( $ro->selectNow("registeredUser","photo","employeeID",$employeeID) != "" ) {
echo "<img src='http://".$ro->getMyUrl()."".$ro->selectNow("registeredUser","photo","employeeID",$employeeID)."' >";
}else {
echo "<form action='upload_file.php' method='post' enctype='multipart/form-data'>";
$ro->coconutHidden("employeeID",$employeeID);
echo "<label for='file'>Photo:</label>";
echo "<input type='file' name='file' id='file'><br>";
echo "<input type='submit' name='submit' value='Submit'>";
echo "</form>";
}
echo "</div>";

/*
echo "Employee ID:&nbsp;".$employeeID;
echo "<br>";
echo "Name:&nbsp;".$ro->selectNow("registeredUser","completeName","employeeID",$employeeID);
echo "<br>";
echo "Position:&nbsp;".$ro->selectNow("registeredUser","position","employeeID",$employeeID);
echo "<br>";
echo "Department:&nbsp;".$ro->selectNow("registeredUser","department","employeeID",$employeeID);
echo "<br>";
echo "Username:&nbsp;".$ro->selectNow("registeredUser","username","employeeID",$employeeID);
echo "<br>";
echo "Module:&nbsp;".$ro->selectNow("registeredUser","module","employeeID",$employeeID);

echo "<br>";
echo "Status:&nbsp;".$ro->selectNow("registeredUser","status","employeeID",$employeeID);
echo "<br>";
echo "Salary:&nbsp;".number_format($ro->selectNow("registeredUser","salaryBasic","employeeID",$employeeID),2);
echo "<br>";
echo "Age:&nbsp;".$ro->selectNow("registeredUser","age","employeeID",$employeeID);
echo "<br>";
echo "Birth Date:&nbsp;".$ro->selectNow("registeredUser","birthdate","employeeID",$employeeID);
echo "<br>";
echo "Address:&nbsp;".$ro->selectNow("registeredUser","address","employeeID",$employeeID);
*/


echo "<br><br><br><br><br><br><br><br><br>";
$ro->coconutFormStart("get",$_SERVER['PHP_SELF']);
$ro->coconutHidden("employeeID",$employeeID);
$ro->coconutHidden("username",$username);
echo "<Br><Br><br>";
echo "<div style='border:1px solid #000; height:110px; width:400px;'>";
echo "";
echo "<table border=0>";
echo "<tr>";
echo "<Td>&nbsp;";
$ro->coconutComboBoxStart_short("fromMonth");
if( isset($_GET['fromMonth']) ) {
echo "<option value='".$_GET['fromMonth']."'>".$_GET['fromMonth']."</option>";
}else {
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
}
$ro->coconutComboBoxStop();
echo "-";
$ro->coconutComboBoxStart_short("fromDay");
if( isset($_GET['fromDay']) ) {
echo "<option value='".$_GET['fromDay']."'>".$_GET['fromDay']."</option>";
}else {
for( $x=1;$x<32;$x++ ) {
if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
}
$ro->coconutComboBoxStop();
echo "-";
if( isset($_GET['fromYear']) ) {
$ro->coconutTextBox_short("fromYear",$_GET['fromYear']);
}else {
$ro->coconutTextBox_short("fromYear",date("Y"));
}
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;";
$ro->coconutComboBoxStart_short("toMonth");
if( isset($_GET['toMonth']) ) {
echo "<option value='".$_GET['toMonth']."'>".$_GET['toMonth']."</option>";
}else {
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
}
$ro->coconutComboBoxStop();
echo "-";
$ro->coconutComboBoxStart_short("toDay");
if( isset($_GET['toDay']) ) {
echo "<option value='".$_GET['toDay']."'>".$_GET['toDay']."</option>";
}else {
for( $x=1;$x<32;$x++ ) {
if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
}

$ro->coconutComboBoxStop();
echo "-";
if( isset($_GET['toYear']) ) {
$ro->coconutTextBox_short("toYear", $_GET['toYear'] );
}else {
$ro->coconutTextBox_short("toYear",date("Y"));
}
echo "</td>";
echo "</tr>";



echo "<tr>";
echo "<td>&nbsp;";
$ro->coconutComboBoxStart_long("monthType");
if( $_GET['monthType'] ) {
echo "<option value='".$_GET['monthType']."'>".$_GET['monthType']."</option>";
}else {
echo "<option value='MONTHLY'> MONTHLY </option>";
echo "<option value='SEMI_MONTHLY'> SEMI MONTHLY </option>";
}
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</div>";
echo "<Br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Salary/Rate</tD>";
echo "<td>";
if( isset($_GET['salary']) ) {
$ro->coconutTextBox_short("salary",$salary);
}else {
$ro->coconutTextBox_short("salary",$ro->selectNow("registeredUser","salaryBasic","employeeID",$employeeID));
}
echo "</td>";

echo "<td>&nbsp;&nbsp;</tD>";
echo "<td>&nbsp;&nbsp;</tD>";
echo "<td>&nbsp;&nbsp;</tD>";

echo "<td>SSS&nbsp;</tD>";
echo "<td>";
if( isset($_GET['sss']) ) {
$ro->coconutTextBox_short("sss",$sssContribution);
}else {
$ro->coconutTextBox_short("sss","0");
}
echo "</td>";

echo "<tD>&nbsp;</td>";
echo "<tD>&nbsp;</td>";
echo "<tD>&nbsp;</td>";
echo "<tD>&nbsp;</td>";
echo "<tD>&nbsp;</td>";
echo "<tD>&nbsp;</td>";

echo "<td><b>Employer Share</b></tD>";

echo "</tr>";

echo "<tr>";
echo "<td>Overtime</tD>";
echo "<td>";
if( isset($_GET['overtime']) ) {
$ro->coconutTextBox_short("overtime",$_GET['overtime']);
}else {
$ro->coconutTextBox_short("overtime","0");
}
echo "</td>";

echo "<td>&nbsp;&nbsp;</tD>";
echo "<td>&nbsp;&nbsp;</tD>";
echo "<td>&nbsp;&nbsp;</tD>";

echo "<td>PhilHealth&nbsp;</td>";
echo "<tD>";

if( isset($_GET['philhealth']) ) {
$ro->coconutTextBox_short("philhealth",$philhealthContribution);
}else {
$ro->coconutTextBox_short("philhealth","0");
}
echo "</td>";


echo "<tD>&nbsp;</td>";
echo "<tD>&nbsp;</td>";
echo "<tD>&nbsp;</td>";
echo "<tD>&nbsp;</td>";
echo "<tD>&nbsp;</td>";
echo "<tD>&nbsp;</td>";

echo "<td>SSS</tD>";
echo "<td>";
if( isset($_GET['sssER']) ) {
$ro->coconutTextBox_short("sssER",$sssEmployerShare);
}else {
$ro->coconutTextBox_short("sssER","0");
}
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Holiday</tD>";
echo "<td>";
if( isset($_GET['holiday']) ) {
$ro->coconutTextBox_short("holiday",$holiday);
}else {
$ro->coconutTextBox_short("holiday","0");
}
echo "</td>";

echo "<td>&nbsp;&nbsp;</tD>";
echo "<td>&nbsp;&nbsp;</tD>";
echo "<td>&nbsp;&nbsp;</tD>";

echo "<td>Pag-ibig</td>";
echo "<td>";

if( isset($_GET['pagibig']) ) {
$ro->coconutTextBox_short("pagibig",$hdmfContribution);
}else {
$ro->coconutTextBox_short("pagibig","0");
}
echo "</td>";


echo "<tD>&nbsp;</td>";
echo "<tD>&nbsp;</td>";
echo "<tD>&nbsp;</td>";
echo "<tD>&nbsp;</td>";
echo "<tD>&nbsp;</td>";
echo "<tD>&nbsp;</td>";

echo "<td>PhilHealth</tD>";	
echo "<td>";
if( isset($_GET['phicEmployerShare']) ) {
$ro->coconutTextBox_short("phicEmployerShare",$phicEmployerShare);
}else {
$ro->coconutTextBox_short("phicEmployerShare","0");
}
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td> NSD </tD>";
echo "<td>";
if( isset($_GET['nsd']) ) {
$ro->coconutTextBox_short("nsd",$_GET['nsd']);
}else {
$ro->coconutTextBox_short("nsd","0");
}
echo "</td>";
echo "<td>&nbsp;&nbsp;</td>";
echo "<td>&nbsp;&nbsp;</tD>";
echo "<td>&nbsp;&nbsp;</td>";

echo "<td>W/ Tax</tD>";
echo "<td>";

if( isset($_GET['wTax']) ) {
$ro->coconutTextBox_short("wTax",$withholdingTax);
}else {
$ro->coconutTextBox_short("wTax","0");
}
echo "</td>";


echo "<tD>&nbsp;</td>";
echo "<tD>&nbsp;</td>";
echo "<tD>&nbsp;</td>";
echo "<tD>&nbsp;</td>";
echo "<tD>&nbsp;</td>";
echo "<tD>&nbsp;</td>";

echo "<td>Pag-ibig</tD>";
echo "<td>";
if( isset($_GET['hdmfEmployerShare']) ) {
$ro->coconutTextBox_short("hdmfEmployerShare",$pagibigEmployerShare);
}else {
$ro->coconutTextBox_short("hdmfEmployerShare","0");
}
echo "</td>";
echo "</tr>";


echo  "<tr>";


echo "<td> <font color=red>Gross</font> </tD>";
echo "<td>";
if( isset($_GET['gross']) ) {
$ro->coconutTextBox_short("gross",$gross);
}else {
$ro->coconutTextBox_short("gross","0");
}
echo "</td>";


echo "<td>&nbsp;&nbsp;</td>";
echo "<td>&nbsp;&nbsp;</td>";
echo "<td>&nbsp;&nbsp;</td>";
//echo "<td>&nbsp;&nbsp;</td>";

echo "<td> Late </td>";
echo "<td>";
if( isset($_GET['late']) ) {
$ro->coconutTextBox_short("late",$late);
}else {
$ro->coconutTextBox_short("late","0");
}
echo "</td>";
echo "</tr>";



echo  "<tr>";

echo "<td>&nbsp;&nbsp;</td>";
echo "<td>&nbsp;&nbsp;</td>";
echo "<td>&nbsp;&nbsp;</td>";
echo "<td>&nbsp;&nbsp;</td>";
echo "<td>&nbsp;&nbsp;</td>";

echo "<td> Absences </td>";
echo "<td>";
if( isset($_GET['absences']) ) {
$ro->coconutTextBox_short("absences",$absences);
}else {
$ro->coconutTextBox_short("absences","0");
}
echo "</td>";
echo "</tr>";



echo  "<tr>";

echo "<td>";
$ro->coconutButton("Calculate");
echo "</td>";
echo "<td>&nbsp;&nbsp;</td>";
echo "<td>&nbsp;&nbsp;</td>";
echo "<td>&nbsp;&nbsp;</td>";
echo "<td>&nbsp;&nbsp;</td>";

echo "<td> <font color=red>Deduction</font> </td>";
echo "<td>";
if( isset($_GET['totalDeduction']) && isset($_GET['wTax']) ) {
$ro->coconutTextBox_short("totalDeduction",($deduction + $withholdingTax));
}else {
$ro->coconutTextBox_short("totalDeduction","0");
}
echo "</td>";
echo "</tr>";


echo "<tr>";

echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";

echo "<td><font color=blue>NET</font>&nbsp;</tD>";
echo "<td>";
if(  isset($_GET['totalDeduction']) && isset($_GET['wTax']) && isset($_GET['total']) ) {
$ro->coconutTextBox_short("total",$gross - ( $deduction + $withholdingTax ) );
}else {
$ro->coconutTextBox_short("total","0");
}
echo "</td>";
echo "</tr>";







echo "</table>";

$ro->coconutFormStop();




if( isset($_GET['salary']) && isset($_GET['overtime']) && isset($_GET['holiday']) && isset($_GET['nsd']) && isset($_GET['gross']) && isset($_GET['sss']) && isset($_GET['philhealth']) && isset($_GET['pagibig']) && isset($_GET['wTax']) && isset($_GET['late']) && isset($_GET['absences']) && isset($_GET['totalDeduction']) && isset($_GET['total']) && isset($_GET['monthType']) && isset($_GET['fromMonth']) && isset($_GET['fromDay']) && isset($_GET['fromYear']) && isset($_GET['toMonth']) && isset($_GET['toDay']) && isset($_GET['toYear']) && isset($_GET['sssER']) && isset($_GET['phicEmployerShare']) && isset($_GET['hdmfEmployerShare']) ) {
echo "<form method='get' action='/COCONUT/payroll/addEmployeePayroll.php'>";
$ro->coconutHidden("employeeID",$employeeID);
$ro->coconutHidden("salary",$_GET['salary']);
$ro->coconutHidden("overtime",$_GET['overtime']);
$ro->coconutHidden("holiday",$_GET['holiday']);
$ro->coconutHidden("nsd",$_GET['nsd']);
$ro->coconutHidden("gross",$gross);
$ro->coconutHidden("sss",$sssContribution);
$ro->coconutHidden("philhealth",$philhealthContribution);
$ro->coconutHidden("pagibig",$hdmfContribution);
$ro->coconutHidden("wTax",$withholdingTax);
$ro->coconutHidden("late",$late);
$ro->coconutHidden("absences",$absences);
$ro->coconutHidden("totalDeduction",( $deduction + $withholdingTax ));
$ro->coconutHidden("total",$gross - ( $deduction + $withholdingTax ) );

$ro->coconutHidden("monthType",$monthType);
$ro->coconutHidden("fromMonth",$_GET['fromMonth']);
$ro->coconutHidden("fromDay",$_GET['fromDay']);
$ro->coconutHidden("fromYear",$_GET['fromYear']);
$ro->coconutHidden("toMonth",$_GET['toMonth']);
$ro->coconutHidden("toDay",$_GET['toDay']);
$ro->coconutHidden("toYear",$_GET['toYear']);
$ro->coconutHidden("username",$username);

$ro->coconutHidden("sssER",$sssEmployerShare);
$ro->coconutHidden("phicEmployerShare",$phicEmployerShare);
$ro->coconutHidden("hdmfEmployerShare",$pagibigEmployerShare);

echo "<input type='submit' value='Save >>>' style='border:1px solid #FF0000'>";
echo "</form>";

}




?>

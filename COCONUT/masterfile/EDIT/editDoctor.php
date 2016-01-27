<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$name = $_GET['name'];
$specialization1 = $_GET['specialization1'];
$specialization2 = $_GET['specialization2'];
$specialization3 = $_GET['specialization3'];
$specialization4 = $_GET['specialization4'];
$specialization5 = $_GET['specialization5'];
$PHIC = $_GET['PHIC'];
$doctorCode = $_GET['doctorCode'];
$usernameDoctor = $_GET['usernameDoctor'];
$password = $_GET['password'];

$ro = new database();


$accNo = preg_split ("/\-/",$PHIC); 

?>
<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/flow/rickyCSS1.css" />
<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />


<style type="text/css">

.panz{
	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 25px;
	border-color:white black black black;
	font-size:18px;
	text-align:center;
}

.panz1{
	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 25px;
	border-color:white black black white;
	font-size:18px;
	text-align:center;
}

</style>

<script type='text/javascript'>
$("#breadcrumbs a").hover(
    function () {
        $(this).addClass("hover").children().addClass("hover");
        $(this).parent().prev().find("span.arrow:first").addClass("pre_hover");
    },
    function () {
        $(this).removeClass("hover").children().removeClass("hover");
        $(this).parent().prev().find("span.arrow:first").removeClass("pre_hover");
    }
);
</script>


<?php

echo "<form method='get' action='editDoctor1.php'>";
echo "<br><center><div style='border:1px solid #000000; width:600px; height:318px; border-color:black black black black;'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='doctorCode' value='$doctorCode'>";
echo "<br><table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td><font class='labelz'>Name of Doctor:&nbsp;</font></td>";
echo "<td><input type=text name='doctorName' value='$name' class='txtBox'></font></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Specialization 1:&nbsp;</font></td>";
echo "<td>";
echo "<select name='specialization1' class='comboBox'>";
echo "<option value='$specialization1'>$specialization1</option>";
$ro->showAllSpecialization();
echo "</select>"; 
echo " </td>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>Specialization 2:&nbsp;</font></td>";
echo "<td>";
echo "<select name='specialization2' class='comboBox'>";
echo "<option value='$specialization2'>$specialization2</option>";
$ro->showAllSpecialization();
echo "</select>"; 
echo " </td>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>Specialization 3:&nbsp;</font></td>";
echo "<td>";
echo "<select name='specialization3' class='comboBox'>";
echo "<option value='$specialization3'>$specialization3</option>";
$ro->showAllSpecialization();
echo "</select>"; 
echo " </td>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>Specialization 4:&nbsp;</font></td>";
echo "<td>";
echo "<select name='specialization4' class='comboBox'>";
echo "<option value='$specialization4'>$specialization4</option>";
$ro->showAllSpecialization();
echo "</select>"; 
echo " </td>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>Specialization 5:&nbsp;</font></td>";
echo "<td>";
echo "<select name='specialization5' class='comboBox'>";
echo "<option value='$specialization5'>$specialization5</option>";
$ro->showAllSpecialization();
echo "</select>"; 
echo " </td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>PHIC Accreditation No:&nbsp;</font></td>";
echo "
<td>
<input type=text name='acc1' value='".substr($accNo[0],-4,1)."' class='panz'><input type=text name='acc2' value='".substr($accNo[0],-3,1)."' class='panz1'><input type=text name='acc3' value='".substr($accNo[0],-2,1)."' class='panz1'><input type=text maxlength=1 name='acc4' value='".substr($accNo[0],-1	,1)."' class='panz1'>-
<input type=text maxlength=1 name='acc5' value='".substr($accNo[1],-7,1)."' class='panz'><input type=text maxlength=1 name='acc6' value='".substr($accNo[1],-6,1)."' class='panz1'><input type=text maxlength=1 name='acc7' value='".substr($accNo[1],-5,1)."' class='panz1'><input type=text maxlength=1 name='acc8' value='".substr($accNo[1],-4,1)."' class='panz1'><input type=text maxlength=1 name='acc9' value='".substr($accNo[1],-3,1)."' class='panz1'><input type=text maxlength=1 name='acc10' value='".substr($accNo[1],-2,1)."' class='panz1'><input type=text maxlength=1 name='acc11' value='".substr($accNo[1],-1,1)."' class='panz1'>-<input type=text maxlength=1 name='acc12' value='".substr($accNo[2],-1,1)."' class='panz'>

</td>";
echo "</tr>";


echo "<Tr>";
echo "<td>Contact:&nbsp;</td>";
echo "<Td>".$ro->coconutTextBox_return("contactNo",$ro->selectNow("Doctors","contact","doctorCode",$doctorCode))."</td>";
echo "</tr>";


echo "<tr>";
echo "<td><font class='labelz'>User Name:&nbsp;</font></td>";
echo "<td><input type=text name='usernameDoctor' value='$usernameDoctor' class='txtBox'></font></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Password:&nbsp;</font></td>";
echo "<td><input type=text name='password' value='$password' class='txtBox'></font></td>";
echo "</tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr>";
echo "<td>&nbsp;</td><td><input type=submit value='Proceed' style='border:1px solid #000; background-color:#3b5998; color:white' ></td>";
echo "</tr>";
echo "</table>";
echo "</div>";
echo "</form>";

?>

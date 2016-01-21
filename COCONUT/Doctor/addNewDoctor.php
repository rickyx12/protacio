<?php
include("../../myDatabase.php");
$username = $_GET['username'];
$ro = new database();
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

echo "<form method='get' action='addNewDoctor1.php'>";
echo "<input type=hidden name='module' value='DOCTOR'>";
echo "<br><center><div style='border:1px solid #000000; width:600px; height:318px; border-color:black black black black;'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<br><table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td><font class='labelz'>Name of Doctor:&nbsp;</font></td>";
echo "<td><input type=text name='doctorName' class='txtBox'></font></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Specialization 1:&nbsp;</font></td>";
echo "<td>";
echo "<select name='specialization1' class='comboBox'>";
$ro->showAllSpecialization();
echo "</select>"; 
echo " </td>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>Specialization 2:&nbsp;</font></td>";
echo "<td>";
echo "<select name='specialization2' class='comboBox'>";
$ro->showAllSpecialization();
echo "</select>"; 
echo " </td>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>Specialization 3:&nbsp;</font></td>";
echo "<td>";
echo "<select name='specialization3' class='comboBox'>";
$ro->showAllSpecialization();
echo "</select>"; 
echo " </td>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>Specialization 4:&nbsp;</font></td>";
echo "<td>";
echo "<select name='specialization4' class='comboBox'>";
$ro->showAllSpecialization();
echo "</select>"; 
echo " </td>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>Specialization 5:&nbsp;</font></td>";
echo "<td>";
echo "<select name='specialization5' class='comboBox'>";
$ro->showAllSpecialization();
echo "</select>"; 
echo " </td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>PHIC Accreditation No:&nbsp;</font></td>";
echo "<td><input type=text name='acc1' maxlength=1 class='panz'><input type=text name='acc2' maxlength=1 class='panz1'><input type=text maxlength=1 name='acc3' class='panz1'><input type=text maxlength=1 name='acc4' class='panz1'>-
<input type=text maxlength=1 name='acc5' class='panz'><input type=text maxlength=1 name='acc6' class='panz1'><input type=text maxlength=1 name='acc7' class='panz1'><input type=text maxlength=1 name='acc8' class='panz1'><input type=text maxlength=1 name='acc9' class='panz1'><input type=text maxlength=1 name='acc10' class='panz1'><input type=text maxlength=1 name='acc11' class='panz1'>-<input type=text maxlength=1 name='acc12' class='panz'>
</td>";
echo "</tr>";

echo "<Tr>";
echo "<td>Contact:&nbsp;</td>";
echo "<Td>".$ro->coconutTextBox_return("contactNo","")."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>User Name:&nbsp;</font></td>";
echo "<td><input type=text name='usernameDoctor' class='txtBox'></font></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Password:&nbsp;</font></td>";
echo "<td><input type=text name='password' class='txtBox'></font></td>";
echo "</tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr>";
echo "<td>&nbsp;</td><td><input type=submit value='Proceed' style='border:1px solid #000; background-color:#3b5998; color:white' ></td>";
echo "</tr>";
echo "</table>";
echo "</div>";
echo "</form>";

?>

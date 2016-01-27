<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Test Codes</title>
<script type="text/JavaScript">
<!--
function placeFocus() {
if (document.forms.length > 0) {
var field = document.forms[0];
for (i = 0; i < field.length; i++) {
if ((field.elements[i].type == "text") || (field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
document.forms[0].elements[i].focus();
break;
         }
      }
   }
}

//-->
</script>
<style type="text/css">
<!--
.style1 {
	font-family: Arial;
	font-size: 14px;
	font-weight: bold;
	color: #000000;
}
.style2 {
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
}
.style3 {
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
	color: #FFFFFF;
}
.textfield01 {
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
	background-color: #FFFFFF;
	border: 1px solid #000000;
}
.button01 {
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
	background-color: #FFFFFF;
	border: 1px solid #000000;
}
-->
</style>
</head>

<body onload="placeFocus()">
<?php
$lastName=$_GET['lastName'];
$firstName=$_GET['firstName'];

echo "
<div align='left'>
  <table width='500' border='0' cellspacing='0' cellpadding='0'>
    <tr>
      <td><div align='left' class='style1'>Search Patinet </div></td>
    </tr>
    <tr>
      <form id='Search' name='Search' method='get' action='SearchResult.php'>
	  <td>
        <table width='100' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td><input name='lastName' type='text' class='textfield01' id='lastName' placeholder='Last Name' value='$lastName' /></td>
            <td><input name='firstName' type='text' class='textfield01' id='firstName' placeholder='First Name' value='$firstName' /></td>
            <td><input name='Submit' type='submit' class='button01' value='Submit' /></td>
          </tr>
        </table>
	  </td>
	  </form>
    </tr>
  </table>
  <br />
  <br />
  <table width='600' border='0' cellspacing='0' cellpadding='0'>
    <tr>
	  <td><div align='left' class='style1'>Search Results</div></td>
	</tr>
	<tr>
      <td bgcolor='#000000'><table width='600' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
        <tr>
          <td width='413' bgcolor='#0066FF' class='style3'><div align='center'>Name</div></td>
          <td width='121' bgcolor='#0066FF' class='style3'><div align='center'>Birthday</div></td>
		  <td width='58' bgcolor='#0066FF' class='style3'><div align='center'>Use</div></td>
        </tr>
";
$y=mysql_connect("192.168.1.207","root","Pr0taci001");
mysql_select_db('Coconut', $y);
$asql=mysql_query("SELECT patientNo, lastName, firstName, middleName, Birthdate FROM patientRecord WHERE lastName LIKE '$lastName%%' AND firstName LIKE '$firstName%%' ORDER BY lastName, firstName");
while($afetch=mysql_fetch_array($asql)){
$qpatientNo=$afetch['patientNo'];
$qlastName=$afetch['lastName'];
$qfirstName=$afetch['firstName'];
$qmiddleName=$afetch['middleName'];
$qBirthdate=$afetch['Birthdate'];

echo "
        <tr>
          <td bgcolor='#FFFFFF' class='style2'><div align='left'>&nbsp;$qlastName, $qfirstName $qmiddleName</div></td>
          <td bgcolor='#FFFFFF' class='style2'><div align='center'>$qBirthdate</div></td>
		  <form id='Use' name='Use' method='get' action='PatientSelected.php'>
		  <input type='hidden' name='patientNo' value='$qpatientNo' />
		  <td bgcolor='#FFFFFF'><div align='center'>
            <input name='UseMe' type='submit' class='button01' value='Use' />
          </div></td>
		  </form>
        </tr>
";
}
mysql_close($y);
echo "
        <tr>
          <td height='6' bgcolor='#0066FF'></td>
          <td height='6' bgcolor='#0066FF'></td>
          <td height='6' bgcolor='#0066FF'></td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>
";
?>
</body>
</html>

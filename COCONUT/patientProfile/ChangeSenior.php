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
	color: #0066FF;
}
.style2 {
	font-family: Arial;
	font-size: 14px;
	font-weight: bold;
	color: #000000;
}
.textfield01 {
	font-family: Arial;
	font-size: 14px;
	font-weight: bold;
	color: #000000;
	background-color: #FFFFFF;
	border: 1px solid #FF0000;
	width: 200px;
	height: 25px;
}
.button01 {
	font-family: Arial;
	font-size: 14px;
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
include("../../myDatabase.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$registrationNo=$_GET['registrationNo'];
$username=$_GET['username'];

$asql=mysql_query("SELECT patientNo FROM registrationDetails WHERE registrationNo='$registrationNo'");
while($afetch=mysql_fetch_array($asql)){$patientNo=$afetch['patientNo'];}

$bsql=mysql_query("SELECT lastName, firstName, middleName, Senior FROM patientRecord WHERE patientNo='$patientNo'");
while($bfetch=mysql_fetch_array($bsql)){$lastName=$bfetch['lastName']; $firstName=$bfetch['firstName']; $middleName=$bfetch['middleName']; $Senior=$afetch['Senior'];}

$lastNamefmt=strtoupper($lastName);
$firstNamefmt=strtoupper($firstName);
$middleNamefmt=strtoupper($middleName);

if(($Senior=='')||($Senior=='NO')){
$csql=mysql_query("SELECT seniorID FROM registrationDetails WHERE registrationNo='$registrationNo'");
while($cfetch=mysql_fetch_array($csql)){$seniorID=$cfetch['seniorID'];}
}
else{
$seniorID='';
}
echo "
<div align='center'>
  <table width='400' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
    <tr>
      <td><table width='400' border='0' cellspacing='0' cellpadding='0'>
        <tr>
          <td width='15' height='15'></td>
          <td width='370' height='15'></td>
          <td width='15' height='15'></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><table width='370' border='0' cellspacing='0' cellpadding='0'>
            <tr>
              <td height='30' class='style1'><div align='center'>Change Patient to Senior </div></td>
            </tr>
            <tr>
              <td height='30' class='style2'> <div align='center'>$lastNamefmt, $firstNamefmt $middleNamefmt</div></td>
            </tr>
            <tr>
              <td><div align='center'>
                <form id='Change' name='Change' method='get' action='ChangeSeniorSave.php'>
				<input type='hidden' name='patientNo' value='$patientNo' />
				<input type='hidden' name='registrationNo' value='$registrationNo' />
				<input type='hidden' name='username' value='$username' />
                  <table width='300' border='0' cellspacing='0' cellpadding='0'>
                    <tr>
                      <td><div align='center'>
                        <input name='seniorID' type='text' class='textfield01' id='seniorID' placeholder='Type Senior ID No.' value='$seniorID' />
                      </div></td>
                    </tr>
                    <tr>
                      <td height='15'></td>
                    </tr>
                    <tr>
                      <td><div align='center'>
                        <input name='Submit' type='submit' class='button01' value='Change' />
                      </div></td>
                    </tr>
                  </table>
                </form>
              </div></td>
            </tr>
          </table></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height='15'></td>
          <td height='15'></td>
          <td height='15'></td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>
";

?>
</body>
</html>

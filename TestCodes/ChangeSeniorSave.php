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
include("../myDatabase.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$registrationNo=$_GET['registrationNo'];
$patientNo=$_GET['patientNo'];
$username=$_GET['username'];
$seniorID=$_GET['seniorID'];

echo "
<div align='center' class='style2'>Loading...</div>
";

mysql_query("UPDATE patientRecord SET Senior='YES' WHERE patientNo='$patientNo'");
mysql_query("UPDATE registrationDetails SET seniorID='$seniorID'");

echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=COCONUT/patientProfile/patientProfile_handler.php?registrationNo=$registrationNo&username=$username'>";

?>
</body>
</html>

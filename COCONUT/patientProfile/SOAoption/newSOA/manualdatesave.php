<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Charges Summary</title>
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

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<style type="text/css">
<!--
.style1 {font-family: Arial;font-size: 16px;color: #000000;font-weight: bold;}
.style2 {font-family: "Times New Roman";font-size: 16px;color: #FF0000;font-weight: bold;}
.style3 {font-family: Arial;font-size: 14px;color: #000000;font-weight: bold;}
.style4 {font-family: Arial;font-size: 12px;color: #000000;font-weight: bold;}
.style5 {font-family: Arial;font-size: 14px;color: #000000;}
.style6 {font-family: Arial;font-size: 14px;color: #0066FF;}
.textfield2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 30px;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
tr:hover { background-color:yellow;color:black;}
-->
</style>
</head>

<body onload="placeFocus()">
<?php
include("../../../../myDatabase.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$show = $_GET['show'];
$chargesCode = $_GET['chargesCode'];
$showdate = $_GET['showdate'];

$setdateY=$_GET['setdateY'];
$setdateM=$_GET['setdateM'];
$setdateD=$_GET['setdateD'];

$settimeH=$_GET['settimeH'];
$settimeM=$_GET['settimeM'];
$settimeS=$_GET['settimeS'];

$setdate=$setdateY.$setdateM.$setdateD;
$settime=$settimeH.":".$settimeM.":".$settimeS;

mysql_query("UPDATE setdatetime SET setdate='$setdate', settime='$settime' WHERE registrationNo='$registrationNo'");

echo "
<div align='left' class='style1'>
<br />
Loading...
</div> 
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=detailedTotalOnly_update.php?registrationNo=$registrationNo&username=$username&show=$show&chargesCode=$chargesCode&showdate=2'>";
?>
</body>
</html>

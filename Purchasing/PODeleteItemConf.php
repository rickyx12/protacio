<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Purchase Order</title>
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
.style1 {font-family: Arial;font-size: 14px;color: #000000;font-weight: bold;}
.style2 {font-family: Arial;font-size: 14px;color: #FF0000;font-weight: bold;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
.button2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #FF0000;border: 1px solid #000000;height: 25px;}
-->
</style>
</head>

<body onload="placeFocus()">
<?php
include("../myDatabase.php");
$cuz = new database();

($GLOBALS["___mysqli_ston"] = mysqli_connect($cuz->myHost(), $cuz->getUser(), $cuz->getPass()));
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $cuz->getDB()));

$username=$_GET['username'];
$poNo=$_GET['poNo'];
$poItemNo=$_GET['poItemNo'];
$description=$_GET['description'];

echo "
<div align='left'>
<span class='style2'>Are you sure you want to delete </span><span class='style1'>$description</span><span class='style2'>?</span>
<table border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <form name='No' method='get' action='CreatedPurchaseOrder.php'>
    <input type='hidden' name='username' value='$username' />
    <input type='hidden' name='poNo' value='$poNo' />
    <td><input type='submit' name='No' class='button1' value='  No?  ' /></td>
    </form>
    <form name='No' method='get' action='PODeleteItemDelete.php'>
    <input type='hidden' name='username' value='$username' />
    <input type='hidden' name='poNo' value='$poNo' />
    <input type='hidden' name='poItemNo' value='$poItemNo' />
    <td><input type='submit' name='Yes' class='button2' value='  Yes?  ' /></td>
    </form>
  </tr>
</table>
</div>
";
?>
</body>
</html>

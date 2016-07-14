<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit Supplier</title>
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
.style2 {font-family: Arial;font-size: 12px;color: #000000;font-weight: bold;}
.style3 {font-family: Arial;font-size: 14px;color: #0066FF;font-weight: bold;}
.style4 {font-family: Arial;font-size: 12px;color: #FFFFFF;font-weight: bold;}
.style5 {font-family: Arial;font-size: 12px;color: #FF0000;font-weight: bold;}
.style6 {font-family: Arial;font-size: 14px;color: #FFFFFF;font-weight: bold;}
.textfield1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
.button2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #0066FF;border: 1px solid #000000;}
.button3 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #FF9900;border: 1px solid #000000;}
.button4 {font-family: Arial;font-size: 12px;font-weight: bold;color: #999999;background-color: #FFFFFF;border: 1px solid #999999;}
.button5 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FF0000;background-color: #FFFFFF;border: 1px solid #FF0000;}
tr:hover { background-color:yellow;color:black;}
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
$supplierCode=$_GET['supplierCode'];

$asql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM supplier WHERE supplierCode='$supplierCode'");
while($afetch=mysqli_fetch_array($asql)){
$supplierName=$afetch['supplierName'];
$contactPerson=$afetch['contactPerson'];
$contactNo=$afetch['contactNo'];
$address=$afetch['address'];
$description=$afetch['description'];
$vatable=$afetch['vatable'];
}

echo "
<div align='lef'>
<table width='400' border='1' bordercolor='#000000' cellspacing='0' cellpadding='0'>
  <tr><form name='edit' method='get' action='EditSupplierAuth.php'>
    <td bgcolor='#0066FF'><table width='400' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td colspan='3' height='25'><div align='left' class='style6'>&nbsp;Edit Supplier</div></td>
      </tr>
      <tr>
        <td width='100'><div align='left' class='style4'>&nbsp;Supplier Name</div></td>
        <td width='15'><div align='center' class='style4'>:</div></td>
        <td width='285'><div align='left' class='style4'><input type='text' name='supplierName' class='textfield1' value='$supplierName' /></div></td>
      </tr>
      <tr>
        <td width='100'><div align='left' class='style4'>&nbsp;Contact Person</div></td>
        <td width='15'><div align='center' class='style4'>:</div></td>
        <td width='285'><div align='left' class='style4'><input type='text' name='contactPerson' class='textfield1' value='$contactPerson' /></div></td>
      </tr>
      <tr>
        <td width='100'><div align='left' class='style4'>&nbsp;Contact Number</div></td>
        <td width='15'><div align='center' class='style4'>:</div></td>
        <td width='285'><div align='left' class='style4'><input type='text' name='contactNo' class='textfield1' value='$contactNo' /></div></td>
      </tr>
      <tr>
        <td width='100'><div align='left' class='style4'>&nbsp;Address</div></td>
        <td width='15'><div align='center' class='style4'>:</div></td>
        <td width='285'><div align='left' class='style4'><textarea name='address' class='textfield1'>$address</textarea></div></td>
      </tr>
      <tr>
        <td width='100'><div align='left' class='style4'>&nbsp;Supplier Description</div></td>
        <td width='15'><div align='center' class='style4'>:</div></td>
        <td width='285'><div align='left' class='style4'><textarea name='description' class='textfield1'>$description</textarea></div></td>
      </tr>
";

if($vatable=='yes'){$vaty="selected='selected'";$vatn="";}
else if($vatable=='no'){$vaty="";$vatn="selected='selected'";}

echo "
      <tr>
        <td><div align='left' class='style4'>&nbsp;Expanded Tax</div></td>
        <td><div align='center' class='style4'>:</div></td>
        <td><div align='left' class='style4'>
          <select name='vatable' class='textfield1'>
            <option value='yes' $vaty>Yes</option>
            <option value='no' $vatn>No</option>
          </select>
        </div></td>
      </tr>
      <tr>
        <td colspan='3' height='30'><div align='right' class='style6'><input type='submit' name='Edit' class='button1' value='Edit &gt;&gt;' />&nbsp;</div></td>
      </tr>
    </table></td>
  <input type='hidden' name='username' value='$username' />
  <input type='hidden' name='supplierCode' value='$supplierCode' />
  </form><tr>
</table>
</div>
";
?>
</body>
</html>

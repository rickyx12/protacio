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
.style2 {font-family: Arial;font-size: 12px;color: #FFFFFF;font-weight: bold;}
.style3 {font-family: Arial;font-size: 14px;color: #0066FF;font-weight: bold;}
.style4 {font-family: Arial;font-size: 14px;color: #FFFFFF;font-weight: bold;}
.style5 {font-family: Arial;font-size: 12px;color: #FF0000;font-weight: bold;}
.style6 {font-family: Arial;font-size: 10px;color: #FFFFFF;font-weight: bold;}
.textfield1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;}
.textfield2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
.button2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #0066FF;border: 1px solid #000000;}
.button3 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #FF9900;border: 1px solid #000000;}
.button4 {font-family: Arial;font-size: 12px;font-weight: bold;color: #999999;background-color: #FFFFFF;border: 1px solid #999999;}
.button5 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FF0000;background-color: #FFFFFF;border: 1px solid #FF0000;}
tr:hover { background-color:red;color:black;}
-->
</style>
</head>

<body onload="placeFocus()">
<?php
include("../myDatabase.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$username=$_GET['username'];
$poNo=$_GET['poNo'];
$poItemNo=$_GET['poItemNo'];
$description=$_GET['description'];
$unit=$_GET['unit'];
$unitPrice=$_GET['unitPrice'];
$quantity=$_GET['quantity'];

echo "
<div align='left'>
<table width='600' border='1' cellpadding='0' cellspacing='0'>
  <form name='POEditItem' method='get' action='POEditItemSave.php'>
  <tr>
    <td bgcolor='#0066FF'><table width='600' border='0' cellpadiing='0' cellspacing'0'>
      <tr>
        <td height='25' colspan='3'><div class='style4' align='left'>&nbsp;Edit Item</div></td>
      </tr>
      <tr>
        <td width='100'><div class='style2' align='left'>&nbsp;Selected Items</div></td>
        <td width='15'><div class='style2' align='center'>:</div></td>
        <td width='485'><div class='style2' align='left'>
          <table width='485' border='0' cellpading='0' cellspacing='0'>
            <tr>
              <td width='200'><div align='left' class='style6'>&nbsp;$description</div></td>
              <td width='100'><div align='center' class='style6'><input type='text' name='unit' size='10' class='textfield1' placeholder='Unit: Ex. Pcs.' value='$unit' /></div></td>
              <td width='100'><div align='center' class='style6'><input type='text' name='unitPrice' size='10' class='textfield1' placeholder='Unit Price' value='$unitPrice' /></div></td>
              <td width='85'><div align='center' class='style6'>Qty.<input type='text' name='quantity' size='4' class='textfield1' value='$quantity' /></div></td>
            </tr>

          </table>
        </div></td>
      </tr>

      <tr>
        <td height='25' colspan='3'><div class='style4' align='right'><input type='submit' name='Submit' class='button1' value='Save &gt;&gt;' />&nbsp;</div></td>
      </tr>
    </table></td>
  </tr>
  <input type='hidden' name='username' value='$username' />
  <input type='hidden' name='poNo' value='$poNo' />
  <input type='hidden' name='poItemNo' value='$poItemNo' />
  </form>
</table>
</div>
";
?>
</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Purchased Items</title>
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
.style3 {font-family: Arial;font-size: 14px;color: #000000;}
.style4 {font-family: Arial;font-size: 12px;color: #FFFFFF;font-weight: bold;}
.style5 {font-family: Arial;font-size: 12px;color: #FF0000;font-weight: bold;}
.textfield1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;}
.button2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #0066FF;border: 1px solid #000000;height: 25px;}
.button3 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #FF9900;border: 1px solid #000000;}
.button4 {font-family: Arial;font-size: 12px;font-weight: bold;color: #999999;background-color: #FFFFFF;border: 1px solid #999999;}
.button5 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FF0000;background-color: #FFFFFF;border: 1px solid #FF0000;}
.button6 {font-family: Arial;font-size: 12px;font-weight: bold;color: #0066FF;background-color: #FFFFFF;border: 1px solid #0066FF;}
.button7 {font-family: Arial;font-size: 12px;font-weight: bold;color: #D3D3D3;background-color: #FFFFFF;border: 1px solid #D3D3D3;}
tr:hover { background-color:yellow;color:black;}
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
$checked=$_GET['checked'];
$show=$_GET['show'];

if($checked==""){$checkedvalue="checked";$value="Check All Items";}
else if($checked=="checked"){$checkedvalue="";$value="Un-check All Items";}

echo "
<div align='left'>
<br />
<table width='70%' bgcolor='#FFFFFF' border='0' cellspacing='0' cellpadding='0'>
  <tr bgcolor='#FFFFFF'>
    <td bgcolor='#FFFFFF'><table width='100%' bgcolor='#FFFFFF' border='0' cellspacing='0' cellpadding='0'>
      <tr bgcolor='#FFFFFF'>
        <form name='Checked' method='get' action='ChangeChargesDate.php'>
        <input type='hidden' name='registrationNo' value='$registrationNo' />
        <input type='hidden' name='username' value='$username' />
        <input type='hidden' name='show' value='$show' />
        <input type='hidden' name='checked' value='$checkedvalue' />
        <td bgcolor='#FFFFFF'><div align='left'><input type='submit' name='Submit' class='button1' value='$value' /></div></td>
        </form>
      <tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor='#FFFFFF'>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor='#FFFFFF'><div align='left'><table border='0'  bgcolor='#FFFFFF' cellspacing='0' cellpadding='0'>
      <tr>
";

$asql=mysql_query("SELECT title FROM patientCharges WHERE registrationNo='$registrationNo' AND status='UNPAID' GROUP BY title ORDER BY title");
while($afetch=mysql_fetch_array($asql)){
$title=$afetch['title'];
if($title==$show){$showclass='button6';}else{$showclass='button1';}

echo "
        <form name='Checked' method='get' action='ChangeChargesDate.php'>
        <input type='hidden' name='registrationNo' value='$registrationNo' />
        <input type='hidden' name='username' value='$username' />
        <input type='hidden' name='checked' value='$checked' />      
        <td><input type='submit' name='show' class='$showclass' value='$title' /></td>
        </form>
";
}

echo "
      </tr>
    </table></div></td>
  </tr>
  <form name='Checked' method='get' action='ChangeChargesDateSD.php'>
  <input type='hidden' name='registrationNo' value='$registrationNo' />
  <input type='hidden' name='username' value='$username' />
  <input type='hidden' name='show' value='$show' />
  <input type='hidden' name='checked' value='$checked' />
  <tr>
    <td bgcolor='#FFFFFF'><table width='100%' border='1' bordercolor='#000000' cellspacing='0' cellpadding='0'>
      <tr>
        <td bgcolor='#0066FF' width='auto'><div align='center' class='style2'>Description</div></td>
        <td bgcolor='#0066FF' width='auto'><div align='center' class='style2'>Price</div></td>
        <td bgcolor='#0066FF' width='auto'><div align='center' class='style2'>Qty.</div></td>
        <td bgcolor='#0066FF' width='auto'><div align='center' class='style2'>Discount</div></td>
        <td bgcolor='#0066FF' width='auto'><div align='center' class='style2'>Total</div></td>
        <td bgcolor='#0066FF' width='auto'><div align='center' class='style2'>Date Charged</div></td>
        <td bgcolor='#0066FF' width='auto'><div align='center' class='style2'>&nbsp;</div></td>
      </tr>
";

$x=0;
$bsql=mysql_query("SELECT itemNo, description, sellingPrice, quantity, discount, total, dateCharge FROM patientCharges WHERE registrationNo='$registrationNo' AND status='UNPAID' AND title='$show' ORDER BY description");
while($bfetch=mysql_fetch_array($bsql)){
$itemNo=$bfetch['itemNo'];
$description=$bfetch['description'];
$sellingPrice=$bfetch['sellingPrice'];
$quantity=$bfetch['quantity'];
$discount=$bfetch['discount'];
$total=$bfetch['total'];
$dateCharge=$bfetch['dateCharge'];

$dateChargestr=strtotime($dateCharge);
$dateChargefmt=date("M d, Y",$dateChargestr);

$x++;
echo "
      <tr>
        <td width='auto'><div align='left' class='style3'>&nbsp;$description</div></td>
        <td width='auto'><div align='right' class='style3'>$sellingPrice&nbsp;</div></td>
        <td width='auto'><div align='center' class='style3'>$quantity</div></td>
        <td width='auto'><div align='right' class='style3'>".number_format($discount,2,'.',',')."&nbsp;</div></td>
        <td width='auto'><div align='right' class='style3'>".number_format($total,2,'.',',')."&nbsp;</div></td>
        <td width='auto'><div align='center' class='style3'>$dateChargefmt</div></td>
        <td width='auto'><div align='center' class='style3'><input type='hidden' name='itemNo$x' value='' /><input type='checkbox' name='itemNo$x' $checked value='$itemNo' /></div></td>
      </tr>
";
}

echo "
    </table></td>
  </tr>
  <tr>
    <td bgcolor='#FFFFFF'><div align='right'><input type='submit' name='submit' class='button2' value='Change Date of Selected Items' /></div></td>
  </tr>
  <input type='hidden' name='ax' value='$x' />
  </form>
</table>
</div>
";
?>
</body>
</html>

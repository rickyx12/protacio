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
.style2 {font-family: Arial;font-size: 12px;color: #000000;font-weight: bold;}
.style3 {font-family: Arial;font-size: 14px;color: #0066FF;font-weight: bold;}
.style4 {font-family: Arial;font-size: 12px;color: #FFFFFF;font-weight: bold;}
.style5 {font-family: Arial;font-size: 12px;color: #FF0000;font-weight: bold;}
.style6 {font-family: Arial;font-size: 16px;color: #000000;font-weight: bold;}
.style7 {font-family: Arial;font-size: 16px;color: #0066FF;font-weight: bold;}
.style8 {font-family: Arial;font-size: 13px;color: #0066FF;font-weight: bold;}
.textfield1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;}
.button2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #0066FF;border: 1px solid #000000;}
.button3 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #FF9900;border: 1px solid #000000;}
.button4 {font-family: Arial;font-size: 12px;font-weight: bold;color: #999999;background-color: #FFFFFF;border: 1px solid #999999;}
.button5 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FF0000;background-color: #FFFFFF;border: 1px solid #FF0000;}
.tableBottom {border-bottom: 2px solid #000000;}
-->
</style>
</head>

<body onload="placeFocus()">
<?php
include("../myDatabase.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$sino=$_GET['sino'];

$asql=mysql_query("SELECT invoiceNo, supplier, terms, transactionDate, recievedDate FROM salesInvoice WHERE siNo='$sino'");
while($afetch=mysql_fetch_array($asql)){
$invoiceNo=$afetch['invoiceNo'];
$supplier=$afetch['supplier'];
$terms=$afetch['terms'];
$transactionDate=$afetch['transactionDate'];
$recievedDate=$afetch['recievedDate'];
}


$bsql=mysql_query("SELECT supplierName, contactNo, address FROM supplier WHERE supplierCode='$supplier'");
while($bfetch=mysql_fetch_array($bsql)){$supplierName=$bfetch['supplierName']; $address=$bfetch['address'];}

echo "
<div align='center'>
<img src='../COCONUT/myImages/ProtacioHeader.png' width='100%' height='auto' />
<br />
<br />
<span class='style6'>PURCHASE REPORT</span>
<br />
<br />
  <table width='95%' border='0' cellspacing='0' cellpadding='0'>
    <tr>
      <td colspan='6' height='2' bgcolor='#000000'></td>
    </tr>
    <tr>
      <td width='15%' height='30'><div align='left' class='style6'>Supplier</div></td>
      <td width='5%' height='30'><div align='center' class='style6'>:</div></td>
      <td width='50%' height='30'><div align='left' class='style7'>$supplierName</div></td>
      <td width='10%' height='30'><div align='left' class='style6'>Invoice No.</div></td>
      <td width='5%' height='30'><div align='center' class='style6'>:</div></td>
      <td width='15%' height='30'><div align='right' class='style7'>$invoiceNo&nbsp;</div></td>
    </tr>
    <tr>
      <td height='30'><div align='left' class='style6'>Address</div></td>
      <td height='30'><div align='center' class='style6'>:</div></td>
      <td height='30'><div align='left' class='style7'>$address</div></td>
      <td height='30'><div align='left' class='style6'>Terms</div></td>
      <td height='30'><div align='center' class='style6'>:</div></td>
      <td height='30'><div align='right' class='style7'>$terms&nbsp;</div></td>
    </tr>
    <tr>
      <td height='30'><div align='left' class='style6'>Transaction Date</div></td>
      <td height='30'><div align='center' class='style6'>:</div></td>
      <td colspan='4 height='30'><div align='left' class='style7'>$transactionDate</div></td>
    </tr>
    <tr>
      <td colspan='6' height='2' bgcolor='#000000'></td>
    </tr>
  </table>
  <br />
  <span class='style1'>PURCHASED ITEMS</span>
  <br />
  <br />
  <table width='95%' border='0' cellspacing='0' cellpadding='0'>
    <tr>
      <td colspan='5' height='2' bgcolor='#000000'></td>
    </tr>
    <tr>
      <td width='10%' height='30' valign='middle'><div align='left' class='style8'>QTY.</div></td>
      <td width='20%' height='30' valign='middle'><div align='left' class='style8'>UNIT</div></td>
      <td width='40%' height='30' valign='middle'><div align='left' class='style8'>DESCRIPTION</div></td>
      <td width='15%' height='30' valign='middle'><div align='right' class='style8'>UNIT PRICE</div></td>
      <td width='15%' height='30' valign='middle'><div align='right' class='style8'>GROSS</div></td>
    </tr>
    <tr>
      <td colspan='5' height='2' bgcolor='#000000'></td>
    </tr>
";


$csql=mysql_query("SELECT description, unit, unitPrice, quantity, (quantity*unitPrice) AS gross FROM salesInvoiceItems WHERE siNo='$sino' ORDER BY refNo");
while($cfetch=mysql_fetch_array($csql)){
$description=$cfetch['description'];
$unit=$cfetch['unit'];
$unitPrice=$cfetch['unitPrice'];
$quantity=$cfetch['quantity'];
$gross=$cfetch['gross'];

$unitPricefmt=number_format($unitPrice,2,'.',',');
$grossfmt=number_format($gross,2,'.',',');

echo "
    <tr>
      <td height='25' valign='middle'><div align='left' class='style2'>$quantity</div></td>
      <td height='25' valign='middle'><div align='left' class='style2'>$unit</div></td>
      <td height='25' valign='middle'><div align='left' class='style2'>$description</div></td>
      <td height='25' valign='middle'><div align='right' class='style2'>$unitPricefmt</div></td>
      <td height='25' valign='middle'><div align='right' class='style2'>$grossfmt</div></td>
    </tr>
";
}

echo "
    <tr>
      <td colspan='5' height='2' bgcolor='#000000'></td>
    </tr>

    <tr>
      <td colspan='5' height='2' bgcolor='#000000'></td>
    </tr>
    <tr>
      <td colspan='5' height='6'></td>
    </tr>
    <tr>
      <td colspan='5'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
        <tr>
          <td width='30%'><div align='left' class='style2'>Prepared by:</div></td>
          <td width='40%'><div align='left' class='style5'></div></td>
          <td width='30%'><div align='left' class='style2'>Approved by:</div></td>
        </tr>
        <tr>
          <td height='30' class='tableBottom'><div align='left' class='style2'></div></td>
          <td height='30'><div align='left' class='style5'></div></td>
          <td height='30' class='tableBottom'><div align='left' class='style2'></div></td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>
";
?>
</body>
</html>

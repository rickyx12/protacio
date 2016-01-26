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
.style2 {font-family: Arial;font-size: 12px;color: #000000;font-weight: bold;}
.style3 {font-family: Arial;font-size: 14px;color: #0066FF;font-weight: bold;}
.style4 {font-family: Arial;font-size: 12px;color: #FFFFFF;font-weight: bold;}
.style5 {font-family: Arial;font-size: 12px;color: #FF0000;font-weight: bold;}
.textfield1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;}
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

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$username=$_GET['username'];
$poNo=$_GET['poNo'];

$asql=mysql_query("SELECT supplier, terms, transactionDate FROM purchaseOrderForm WHERE poNo='$poNo'");
while($afetch=mysql_fetch_array($asql)){
$supplier=$afetch['supplier'];
$terms=$afetch['terms'];
$transactionDate=$afetch['transactionDate'];
}

$truesupplier=preg_split("/-/",$supplier);

$bsql=mysql_query("SELECT supplierName, contactNo, Address FROM supplier WHERE supplierCode='$truesupplier[0]'");
while($bfetch=mysql_fetch_array($bsql)){$supplierName=$bfetch['supplierName']; $Address=$bfetch['Address'];}

echo "
<div align='left'>
<br />
<span class='style1'>Purchase Order</span>
<br />
  <table width='700' border='0' cellspacing='0' cellpadding='0'>
    <tr>
      <td><table width='700' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
        <tr>
          <td width='444'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
            <tr>
              <td height='40' valign='middle'><div align='left' class='style1'>&nbsp;$supplierName</div></td>
            </tr>
            <tr>
              <td height='30' valign='middle'><div align='left' class='style2'>&nbsp;$Address</div></td>
            </tr>
          </table></td>
";

$zsql=mysql_query("SELECT SUM(quantity*unitPrice) AS total FROM purchaseOrderItems WHERE poNo='$poNo'");
while($zfetch=mysql_fetch_array($zsql)){$total=$zfetch['total'];}

$totalfmt=number_format($total,2,'.',',');

echo "
          <td width='250' valign='top'><div align='center'>
            <table width='100%' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td width='40%' height='20'><div align='left' class='style1'>&nbsp;PO No.</div></td>
                <td width='10' height='20'><div align='center' class='style1'>:</div></td>
                <td width='50%' height='20'><div align='right' class='style3'>$poNo&nbsp;</div></td>
              </tr>
              <tr>
                <td width='40%' height='20'><div align='left' class='style1'>&nbsp;Terms</div></td>
                <td width='10' height='20'><div align='center' class='style1'>:</div></td>
                <td width='50%' height='20'><div align='right' class='style3'>$terms&nbsp;</div></td>
              </tr>
              <tr>
                <td width='40%' height='30'><div align='left' class='style1'>&nbsp;Total</div></td>
                <td width='10' height='30'><div align='center' class='style1'>:</div></td>
                <td width='50%' height='30'><div align='right' class='style3'>$totalfmt&nbsp;</div></td>
              </tr>
            </table>
          </div></td>
";


echo "
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height='10'></td>
    </tr>
    <tr>
      <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
";



echo "
        <tr>
	  <form id='AddItems' name='AddItems' method='get' action='AddPurchaseItem.php'>
	  <input type='hidden' name='username' value='$username' />
	  <input type='hidden' name='poNo' value='$poNo' />
	  <input type='hidden' name='show' value='Medicine' />
	  <input type='hidden' name='sort' value='1' />
	  <td width='50%'><div align='left'>
            <input name='AddItems' type='submit' class='button2' id='AddItems' value='Add Items' />
	  </div></td>
	  </form>
          <td width='50%'><div align='right'>
            <input name='Submit' type='button' class='button3' onclick=MM_openBrWindow('PurchaseOrder.php?username=$username&poNo=$poNo','','toolbar=yes,location=yes,status=yes,scrollbars=yes,width=1000,height=700') value='View Purchase Order' />
          </div></td>
        </tr>
";


echo "
      </table></td>
    </tr>
";

echo "
    <tr>
      <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
        <tr>
          <td colspan='2' bgcolor='#000000'><table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
            <tr>
              <td width='17%' bgcolor='#0066FF' class='style4'><div align='center'>Qty./Unit</div></td>
              <td width='50%' bgcolor='#0066FF' class='style4'><div align='center'>Description</div></td>
              <td width='13%' bgcolor='#0066FF' class='style4'><div align='center'>Unit Price</div></td>
              <td width='10%' bgcolor='#0066FF' class='style4'><div align='center'>Edit</div></td>
              <td width='10%' bgcolor='#0066FF' class='style5'><div align='center'>Del.</div></td>
            </tr>
";

$asql=mysql_query("SELECT poItemNo, description, quantity, unit, unitPrice FROM purchaseOrderItems WHERE poNo='$poNo' ORDER BY description");
while($afetch=mysql_fetch_array($asql)){
$poItemNo=$afetch['poItemNo'];
$description=$afetch['description'];
$unit=$afetch['unit'];
$unitPrice=$afetch['unitPrice'];
$quantity=$afetch['quantity'];

$unitPricefmt=number_format($unitPrice,2,'.',',');

$amount=$quantity*$unitPrice;
$amountfmt=number_format($amount,2,'.',',');

echo "
            <tr bgcolor='#FFFFFF'>
              <td class='style2'><div align='left'>&nbsp;$quantity $unit</div></td>
              <td class='style2'><div align='left'>&nbsp;$description</div></td>
              <td class='style2'><div align='center'>$unitPricefmt</div></td>
              <form id='Edit' name='Edit' method='get' action='POEditItem.php'>
              <input type='hidden' name='username' value='$username' />
              <input type='hidden' name='poNo' value='$poNo' />
              <input type='hidden' name='poItemNo' value='$poItemNo' />
              <input type='hidden' name='description' value='$description' />
              <input type='hidden' name='unit' value='$unit' />
              <input type='hidden' name='unitPrice' value='$unitPrice' />
              <input type='hidden' name='quantity' value='$quantity' />
              <td class='style2'><div align='center'>
                <input type='submit' name='Edit' class='button1' value='  E  ' />
              </div></td>
              </form>
              <form id='Delete' name='Delete' method='get' action='DeleteItemConf.php'>
              <input type='hidden' name='username' value='$username' />
              <input type='hidden' name='poNo' value='$poNo' />
              <input type='hidden' name='poItemNo' value='$poItemNo' />
              <td class='style2'><div align='center'>
                <input type='submit' name='Delete' class='button5' value='  X  ' />
              </div></td>
              </form>
            </tr>
";
}


echo "
            <tr>
              <td height='6' bgcolor='#0066FF'></td>
              <td height='6' bgcolor='#0066FF'></td>
              <td height='6' bgcolor='#0066FF'></td>
              <td height='6' bgcolor='#0066FF'></td>
              <td height='6' bgcolor='#0066FF'></td>
            </tr>
          </table></td>
          </tr>
      </table></td>
    </tr>
  </table>
</div>
";
?>
</body>
</html>

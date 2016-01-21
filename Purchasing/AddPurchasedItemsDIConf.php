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
.style6 {font-family: Arial;font-size: 14px;color: #FF0000;font-weight: bold;}
.textfield1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;}
.button2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #0066FF;border: 1px solid #000000;}
.button3 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #FF9900;border: 1px solid #000000;}
.button4 {font-family: Arial;font-size: 12px;font-weight: bold;color: #999999;background-color: #FFFFFF;border: 1px solid #999999;}
.button5 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FF0000;background-color: #FFFFFF;border: 1px solid #FF0000;}
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
$sino=$_GET['sino'];
$page=$_GET['page'];
$refNo=$_GET['refNo'];

$asql=mysql_query("SELECT invoiceNo, supplier, terms, transactionDate, recievedDate FROM salesInvoice WHERE siNo='$sino'");
while($afetch=mysql_fetch_array($asql)){
$invoiceNo=$afetch['invoiceNo'];
$supplier=$afetch['supplier'];
$terms=$afetch['terms'];
$transactionDate=$afetch['transactionDate'];
$recievedDate=$afetch['recievedDate'];
}

$bsql=mysql_query("SELECT supplierName, contactNo, Address FROM supplier WHERE supplierCode='$supplier'");
while($bfetch=mysql_fetch_array($bsql)){$supplierName=$bfetch['supplierName']; $Address=$bfetch['Address'];}

echo "
<div align='left' onfocus='MM_openBrWindow('PurchseReport.php','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,width=400,height=600')'>
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

$csql=mysql_query("SELECT SUM(quantity*unitPrice) AS total FROM salesInvoiceItems WHERE siNo='$sino' ORDER BY refNo");
while($cfetch=mysql_fetch_array($csql)){$total=$cfetch['total'];}

$totalfmt=number_format($total,2,'.',',');

echo "
          <td width='250'><div align='center'>
            <table width='100%' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td width='40%' height='20'><div align='left' class='style1'>&nbsp;Invoice No.</div></td>
                <td width='10' height='20'><div align='center' class='style1'>:</div></td>
                <td width='50%' height='20'><div align='right' class='style3'>$invoiceNo&nbsp;</div></td>
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
	  <form id='AddItems' name='AddItems' method='get' action='searchStockCard.php'>
	  <input type='hidden' name='username' value='$username' />
	  <input type='hidden' name='sino' value='$sino' />
	  <input type='hidden' name='page' value='$page' />
	  <td width='50%'><div align='left'>
            <input name='AddItems' type='submit' class='button2' id='AddItems' value='Add Purchased Items' />
	  </div></td>
	  </form>
          <td width='50%'><div align='right'>
            <input name='Submit' type='button' class='button3' onclick=MM_openBrWindow('PurchaseReport.php?sino=$sino','','toolbar=yes,location=yes,status=yes,scrollbars=yes,width=1000,height=700') value='View Purchased Report' />
          </div></td>
        </tr>
";


echo "
      </table></td>
    </tr>
";

$dsql=mysql_query("SELECT refNo, description, unit, unitPrice, quantity FROM salesInvoiceItems WHERE refNo='$refNo'");
while($dfetch=mysql_fetch_array($dsql)){$description=$dfetch['description'];}

echo "
    <tr>
      <td height='20'></td>
    </tr>
    <tr>
      <td><div align='Left'><span class='style6'>Are you sure you want to delete </span><span class='style1'>$description</span><span class='style6'>?</span></div></td>
    </tr>
    <tr>
      <td><div align='left'>
        <table border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <form name='No' id='No' method='get' action='CreatedReceivingReport.php'>
            <input type='hidden' name='username' value='$username' />
            <input type='hidden' name='sino' value='$sino' />
            <input type='hidden' name='page' value='$page' />
            <td><input type='submit' name='No' class='button2' value='  No?  ' /></td>
            </form>
            <form name='Yes' id='Yes' method='get' action='AddPurchasedItemsDIDel.php'>
            <input type='hidden' name='username' value='$username' />
            <input type='hidden' name='sino' value='$sino' />
            <input type='hidden' name='page' value='$page' />
            <input type='hidden' name='refNo' value='$refNo' />
            <td><input type='submit' name='Yes' class='button5' value='  Yes? ' /></td>
            </form>
          </tr>
        </table>
      </div></td>
    </tr>
  </table>
</div>
";
?>
</body>
</html>

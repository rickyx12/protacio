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
.style1 {font-family: Arial;font-size: 16px;color: #000000;font-weight: bold;}
.style2 {font-family: "Times New Roman";font-size: 16px;color: #FF0000;font-weight: bold;}
.style3 {font-family: Arial;font-size: 14px;color: #000000;font-weight: bold;}
.style4 {font-family: Arial;font-size: 12px;color: #000000;font-weight: bold;}
.style5 {font-family: Arial;font-size: 12px;color: #000000;}
.tableBottom {border-bottom: 2px solid #000000;}
.tableBottomSides {border-bottom: 2px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;}
.tableBottomLeftSides {border-bottom: 2px solid #000000;border-left: 2px solid #000000;border-right: 1px solid #000000;}
.tableBottomRightSides {border-bottom: 2px solid #000000;border-left: 1px solid #000000;border-right: 2px solid #000000;}
.tableTopSides {border-top: 2px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;}
.tableTopLeftSides {border-top: 2px solid #000000;border-left: 2px solid #000000;border-right: 1px solid #000000;}
.tableTopRightSides {border-top: 2px solid #000000;border-left: 1px solid #000000;border-right: 2px solid #000000;}
.tableTopBottomSides {border-top: 2px solid #000000;border-bottom: 2px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;}
.tableTopBottomLeftSides {border-top: 2px solid #000000;border-bottom: 2px solid #000000;border-left: 2px solid #000000;border-right: 1px solid #000000;}
.tableTopBottomRightSides {border-top: 2px solid #000000;border-bottom: 2px solid #000000;border-left: 1px solid #000000;border-right: 2px solid #000000;}
.tableSides {border-left: 1px solid #000000;border-right: 1px solid #000000;}
.tableSidesLeft {border-left: 2px solid #000000;border-right: 1px solid #000000;}
.tableSidesRight {border-left: 1px solid #000000;border-right: 2px solid #000000;}

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

$asql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT supplier, terms, transactionDate FROM purchaseOrderForm WHERE poNo='$poNo'");
while($afetch=mysqli_fetch_array($asql)){$supplier=$afetch['supplier'];$terms=$afetch['terms'];$transactionDate=$afetch['transactionDate'];}

$suppliersplit=preg_split("/-/", $supplier);

$transactionDatestr=strtotime($transactionDate);
$transactionDatefmt=date("M d, Y",$transactionDatestr);

echo "
<div align='center'>
<table width='100%' border='0' cellpspacing='0' cellpadding='0'>
  <tr>
    <td colspan='3'><img src='../COCONUT/myImages/ProtacioHeader.png' width='100%' height='auto' /></td>
  </tr>
  <tr>
    <td width='25%' height='50'><div align='center' class='style1'></div></td>
    <td width='50%' height='50'><div align='center' class='style1'>PURCHASE ORDER</div></td>
    <td width='25%' height='50' valign='top'><div align='right'><span class='style3'>No.: </span><span class='style2'>$poNo&nbsp;&nbsp;</span></div></td>
  </tr>
  <tr>
    <td colspan='3'><table width='100%' boreder='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='10%'><div align='left' class='style4'>SELLER</div></td>
        <td width='2%'><div align='center' class='style4'>:</div></td>
        <td width='54%' class='tableBottom'><div align='left' class='style3'>".$suppliersplit[1]."</div></td>
        <td width='5%'><div align='center' class='style3'></div></td>
        <td width='7%'><div align='letf' class='style4'>DATE</div></td>
        <td width='2%'><div align='center' class='style4'>:</div></td>
        <td width='20%' class='tableBottom'><div align='left' center' class='style3'>$transactionDatefmt</div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan='3'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td height='30' width='20%' class='tableTopLeftSides'><div align='center' class='style4'>TERMS</div></td>
        <td height='30' width='20%' class='tableTopSides'><div align='center' class='style4'>DELIVERY DATE</div></td>
        <td height='30' width='20%' class='tableTopSides'><div align='center' class='style4'>DEPT. CODE</div></td>
        <td height='30' width='20%' class='tableTopSides'><div align='center' class='style4'>REFERENCE</div></td>
        <td height='30' width='20%' class='tableTopRightSides'><div align='center' class='style4'>REQUISITION NO.</div></td>
      </tr>
      <tr>
        <td height='25' width='20%' class='tableBottomLeftSides'><div align='center' class='style4'>$terms</div></td>
        <td height='25' width='20%' class='tableBottomSides'><div align='center' class='style4'></div></td>
        <td height='25' width='20%' class='tableBottomSides'><div align='center' class='style4'></div></td>
        <td height='25' width='20%' class='tableBottomSides'><div align='center' class='style4'></div></td>
        <td height='25' width='20%' class='tableBottomRightSides'><div align='center' class='style4'></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan='3' height='6'></td>
  </tr>
  <tr>
    <td colspan='3'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td height='25' width='20%' class='tableTopBottomLeftSides'><div align='center' class='style4'>Quantity/Unit</div></td>
        <td height='25' width='45%' class='tableTopBottomSides'><div align='center' class='style4'>Description</div></td>
        <td height='25' width='15%' class='tableTopBottomSides'><div align='center' class='style4'>Unit Price</div></td>
        <td height='25' width='20%' class='tableTopBottomRightSides'><div align='center' class='style4'>Amount</div></td>
      </tr>
";

$bsql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT description, quantity, unit, unitPrice FROM purchaseOrderItems WHERE poNo='$poNo' ORDER BY description");
$totalAmount=0;
while($bfetch=mysqli_fetch_array($bsql)){
$description=$bfetch['description'];
$quantity=$bfetch['quantity'];
$unit=$bfetch['unit'];
$unitPrice=$bfetch['unitPrice'];
$amount=$quantity*$unitPrice;
$totalAmount+=$amount;
echo "
      <tr>
        <td height='20' width='20%' class='tableSidesLeft'><div align='left' class='style5'>&nbsp;$quantity $unit</div></td>
        <td height='20' width='45%' class='tableSides'><div align='left' class='style5'>&nbsp;$description</div></td>
        <td height='20' width='15%' class='tableSides'><div align='right' class='style5'>".number_format($unitPrice,2,'.',',')."&nbsp;</div></td>
        <td height='20' width='20%' class='tableSidesRight'><div align='right' class='style5'>".number_format($amount,2,'.',',')."&nbsp;</div></td>
      </tr>
";
}

echo "
      <tr>
        <td height='20' width='20%' class='tableTopBottomLeftSides' colspan='3'><div align='right' class='style4'>Total:&nbsp;</div></td>
        <td height='20' width='20%' class='tableTopBottomRightSides'><div align='right' class='style4'>".number_format($totalAmount,2,'.',',')."&nbsp;</div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan='3' height='6'></td>
  </tr>
  <tr>
    <td colspan='3'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='30%'><div align='left' class='style5'>Prepared by:</div></td>
        <td width='40%'><div align='left' class='style5'></div></td>
        <td width='30%'><div align='left' class='style5'>Approved by:</div></td>
      </tr>
      <tr>
        <td height='30' class='tableBottom'><div align='left' class='style5'></div></td>
        <td height='30'><div align='left' class='style5'></div></td>
        <td height='30' class='tableBottom'><div align='left' class='style5'></div></td>
      </tr>
    </table></td>
  </tr>
</table>
</div>
";
?>
</body>
</html>

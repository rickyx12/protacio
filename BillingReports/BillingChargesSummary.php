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
.style7 {font-family: Arial;font-size: 14px;color: #FF0000;}
.style8 {font-family: Arial;font-size: 12px;color: #FFFFFF;font-weight: bold;}
.tableBottom {border-bottom: 2px solid #000000;}
.tableTop {border-top: 2px solid #000000;}
.tableTopBottom {border-top: 2px solid #000000;border-bottom: 2px solid #000000;}
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
.tableBottomSides {border-bottom: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;}
.tableBottomRight {border-bottom: 1px solid #000000;border-right: 1px solid #000000;}
.tableBottomLeft {border-bottom: 1px solid #000000;border-left: 1px solid #000000;}
.tableRight {border-right: 1px solid #000000;}
.tableLeft {border-left: 1px solid #000000;}
.table2Top2Bottom1Sides {border-top: 2px solid #000000;border-bottom: 2px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;}
.table2Top2Bottom1Right {border-top: 2px solid #000000;border-bottom: 2px solid #000000;border-right: 1px solid #000000;}
.table2Top2Bottom1Left {border-top: 2px solid #000000;border-bottom: 2px solid #000000;border-left: 1px solid #000000;}
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
$registrationNo=$_GET['registrationNo'];

echo "
<div align='center'>
<table width='100%' bgcolor='#FFFFFF' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td><div align='left' class='style1'>Patient Charges Summary</td>
  </tr>
  <tr>
    <td bgcolor='#FFFFFF'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
";


$asql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT title FROM patientCharges WHERE registrationNo='$registrationNo' AND (status NOT LIKE 'DELETED_%%%%' OR status NOT LIKE 'PAID') GROUP BY title ORDER BY title ");
while($afetch=mysqli_fetch_array($asql)){
echo "
      <tr>
        <td colspan='8' height='30' class='tableTopBottom' valign='bottom'><div align='left' class='style3'>".$afetch['title']."</div></td>
      </tr>
      <tr>
        <td class='tableBottomRight' width='auto'><div align='center' class='style4'>Qty.</div></td>
        <td class='tableBottomSides' width='auto'><div align='left' class='style4'>&nbsp;Description</div></td>
        <td class='tableBottomSides' width='auto'><div align='center' class='style4'>Price</div></td>
        <td class='tableBottomSides' width='auto'><div align='center' class='style4'>Discount</div></td>
        <td class='tableBottomSides' width='auto'><div align='center' class='style4'>Unpaid</div></td>
        <td class='tableBottomSides' width='auto'><div align='center' class='style4'>PHIC</div></td>
        <td class='tableBottomSides' width='auto'><div align='center' class='style4'>Company/HMO</div></td>
        <td class='tableBottomLeft' width='auto'><div align='center' class='style4'>Sub Total</div></td>
      </tr>
";

$totdiscount=0;
$totcashUnpaid=0;
$totphic=0;
$totcompany=0;
$finaltotal=0;

if(($afetch['title']=="MEDICINE")||($afetch['title']=="SUPPLIES")){
$bsql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT description FROM patientCharges WHERE registrationNo='$registrationNo' AND title='".$afetch['title']."' AND status='UNPAID' AND departmentStatus LIKE 'dispensedBy%%%%' GROUP BY description, sellingPrice ORDER BY description");
while($bfetch=mysqli_fetch_array($bsql)){
$description=$bfetch['description'];

$subquantity=0;
$subdiscount=0;
$subcashUnpaid=0;
$subphic=0;
$subcompany=0;
$subtotal=0;
$csql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sellingPrice, quantity, discount, cashUnpaid, phic, company FROM patientCharges WHERE registrationNo='$registrationNo' AND description='$description' AND status='UNPAID' AND departmentStatus LIKE 'dispensedBy%%%%' ORDER BY itemNo");
while($cfetch=mysqli_fetch_array($csql)){
$sellingPrice=$cfetch['sellingPrice'];
$quantity=$cfetch['quantity'];
$discount=$cfetch['discount'];
$cashUnpaid=$cfetch['cashUnpaid'];
$phic=$cfetch['phic'];
$company=$cfetch['company'];

$subquantity+=$quantity;
$subdiscount+=$discount;
$subcashUnpaid+=$cashUnpaid;
$subphic+=$phic;
$subcompany+=$company;
$subtotal+=($sellingPrice*$quantity);

}

$totdiscount+=$subdiscount;
$totcashUnpaid+=$subcashUnpaid;
$totphic+=$subphic;
$totcompany+=$subcompany;
$finaltotal+=$subtotal;

echo "
      <tr>
        <td class='tableRight' width='auto'><div align='center' class='style5'>$subquantity</div></td>
        <td class='tableSides' width='auto'><div align='left' class='style5'>&nbsp;".strtoupper($description)."</div></td>
        <td class='tableSides' width='auto'><div align='right' class='style5'>".number_format($sellingPrice,2,'.',',')."&nbsp;</div></td>
        <td class='tableSides' width='auto'><div align='right' class='style5'>".number_format($subdiscount,2,'.',',')."&nbsp;</div></td>
        <td class='tableSides' width='auto'><div align='right' class='style5'>".number_format($subcashUnpaid,2,'.',',')."&nbsp;</div></td>
        <td class='tableSides' width='auto'><div align='right' class='style5'>".number_format($subphic,2,'.',',')."&nbsp;</div></td>
        <td class='tableSides' width='auto'><div align='right' class='style5'>".number_format($subcompany,2,'.',',')."&nbsp;</div></td>
        <td class='tableLeft' width='auto'><div align='right' class='style5'>".number_format(($sellingPrice*$subquantity),2,'.',',')."</div></td>
      </tr>
";
}

}
else{
$bsql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT description, sellingPrice, SUM(quantity) AS quantity, SUM(discount) AS discount, SUM(cashUnpaid) AS cashUnpaid, SUM(phic) AS phic, SUM(company) AS company, departmentStatus FROM patientCharges WHERE registrationNo='$registrationNo' AND title='".$afetch['title']."' AND (status='UNPAID' OR status='Discharged') GROUP BY description, sellingPrice ORDER BY description");
while($bfetch=mysqli_fetch_array($bsql)){
$sellingPriceNotReal=$bfetch['sellingPrice'];
if($afetch['title']=='PROFESSIONAL FEE'){$splitprice=preg_split('[/]',$sellingPriceNotReal); $sellingPrice=$splitprice[0];}else{$sellingPrice=$sellingPriceNotReal;}

$description=$bfetch['description'];
$quantity=$bfetch['quantity'];
$discount=$bfetch['discount'];
$cashUnpaid=$bfetch['cashUnpaid'];
$phic=$bfetch['phic'];
$company=$bfetch['company'];

$totdiscount+=$discount;
$totcashUnpaid+=$cashUnpaid;
$totphic+=$phic;
$totcompany+=$company;
$finaltotal+=($sellingPrice*$quantity);

echo "
      <tr>
        <td class='tableRight' width='auto'><div align='center' class='style5'>$quantity</div></td>
        <td class='tableSides' width='auto'><div align='left' class='style5'>&nbsp;".strtoupper($description)."</div></td>
        <td class='tableSides' width='auto'><div align='right' class='style5'>".number_format($sellingPrice,2,'.',',')."&nbsp;</div></td>
        <td class='tableSides' width='auto'><div align='right' class='style5'>".number_format($discount,2,'.',',')."&nbsp;</div></td>
        <td class='tableSides' width='auto'><div align='right' class='style5'>".number_format($cashUnpaid,2,'.',',')."&nbsp;</div></td>
        <td class='tableSides' width='auto'><div align='right' class='style5'>".number_format($phic,2,'.',',')."&nbsp;</div></td>
        <td class='tableSides' width='auto'><div align='right' class='style5'>".number_format($company,2,'.',',')."&nbsp;</div></td>
        <td class='tableLeft' width='auto'><div align='right' class='style5'>".number_format(($sellingPrice*$quantity),2,'.',',')."</div></td>
      </tr>
";
}
}

echo "
      <tr>
        <td class='table2Top2Bottom1Right' width='auto' colspan='3' height='20'><div align='left' class='style4'>TOTAL</div></td>
        <td class='table2Top2Bottom1Sides' width='auto'><div align='right' class='style4'>".number_format($totdiscount,2,'.',',')."&nbsp;</div></td>
        <td class='table2Top2Bottom1Sides' width='auto'><div align='right' class='style4'>".number_format($totcashUnpaid,2,'.',',')."&nbsp;</div></td>
        <td class='table2Top2Bottom1Sides' width='auto'><div align='right' class='style4'>".number_format($totphic,2,'.',',')."&nbsp;</div></td>
        <td class='table2Top2Bottom1Sides' width='auto'><div align='right' class='style4'>".number_format($totcompany,2,'.',',')."&nbsp;</div></td>
        <td class='table2Top2Bottom1Left' width='auto'><div align='right' class='style4'>".number_format($finaltotal,2,'.',',')."</div></td>
      </tr>
";
}

echo "
    </table></td>
  </tr>
</table>
</div> 
";
?>
</body>
</html>

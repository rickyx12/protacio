<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Accounting 101</title>
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

-->
</style>
</head>

<body onload="placeFocus()">
<?php
include("../../myDatabase.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$username=$_GET['username'];

$fmonth=$_GET['fmonth'];
$fday=$_GET['fday'];
$fyear=$_GET['fyear'];
$tmonth=$_GET['tmonth'];
$tday=$_GET['tday'];
$tyear=$_GET['tyear'];

$fdate=$fyear.$fmonth.$fday;
$fdatestr=strtotime($fdate);
$fdatefmt=date("M d, Y",$fdatestr);
$tdate=$tyear.$tmonth.$tday;
$tdatestr=strtotime($tdate);
$tdatefmt=date("M d, Y",$tdatestr);

echo "
<div align='center'>
<img src='../../COCONUT/myImages/ProtacioHeader.png' width='100%' height='auto' />
<br />
<br />
<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td colspan='5' height='30'><div align='left' class='style3'>From $fdatefmt To $tdatefmt</div></td>
  </tr>
  <tr>
    <td class='tableTopSides' width='auto' height='25'><div align='left' class='style4'>&nbsp;Supplier</div></td>
    <td class='tableTopSides' width='auto' height='25'><div align='left' class='style4'>&nbsp;Acct. Title</div></td>
    <td class='tableTopSides' width='auto' height='25'><div align='left' class='style4'>&nbsp;Acct. Title</div></td>
    <td class='tableTopSides' width='auto' height='25'><div align='center' class='style4'>Debit</div></td>
    <td class='tableTopSides' width='auto' height='25'><div align='center' class='style4'>Credit</div></td>
  </tr>
";

$num=0;
$totamountwovat=0;
$totamountvat=0;
$finaltotamount=0;
$asql=mysql_query("SELECT siNo, invoiceNo, supplier, recievedDate FROM salesInvoice WHERE (recievedDate BETWEEN '$fdate' AND '$tdate') AND status='Active' ORDER BY recievedDate");
$acount=mysql_num_rows($asql);
while($afetch=mysql_fetch_array($asql)){
$siNo=$afetch['siNo'];
$invoiceNo=$afetch['invoiceNo'];
$supplier=$afetch['supplier'];
$recievedDate=$afetch['recievedDate'];

$recievedDatestr=strtotime($recievedDate);
$recievedDatefmt=date("M d, Y",$recievedDatestr);

$bsql=mysql_query("SELECT supplierName, vatable FROM supplier WHERE supplierCode='$supplier'");
while($bfetch=mysql_fetch_array($bsql)){$supplierName=$bfetch['supplierName'];$vatable=$bfetch['vatable'];}

$csql=mysql_query("SELECT SUM(unitPrice*quantity) AS totamount FROM salesInvoiceItems WHERE siNo='$siNo'");
while($cfetch=mysql_fetch_array($csql)){$totamount=$cfetch['totamount'];}

$amountwovat=$totamount/1.12;
$amountvat=$totamount-$amountwovat;

$amountwovatfmt=number_format($amountwovat,2,'.',',');
$amountvatfmt=number_format($amountvat,2,'.',',');
$totamountfmt=number_format($totamount,2,'.',',');


$num++;
$dsql=mysql_query("SELECT checkedNo, amount, date, bank, vat, wtax FROM vouchers WHERE invoiceNo LIKE '$invoiceNo'");
$dcount[$num]=mysql_num_rows($dsql);
while($dfetch=mysql_fetch_array($dsql)){
$vcheckedNo=$dfetch['checkedNo'];
$vamount=$dfetch['amount'];
$vdate=$dfetch['date'];
$vbank=$dfetch['bank'];
$vvat=$dfetch['vat'];
$vwtax=$dfetch['wtax'];
}

if($dcount[$num]!=0){
$totalpay=$vamount+$vvat+$vwtax;
$payamount=$vamount+$vvat;

$vdatestr=strtotime($vdate);
$vdatefmt=date("M d, Y",$vdatestr);

$totalpayfmt=number_format($totalpay,2,'.',',');
$payamountfmt=number_format($payamount,2,'.',',');
$vwtaxfmt=number_format($vwtax,2,'.',',');
}

echo "
  <tr>
";

if($dcount[$num]!=0){
$totamountwovat+=($amountwovat+$totalpay);
$totamountvat+=$amountvat;
$finaltotamount+=($totamount+$payamount+$vwtax);

if($vatable=='yes'){
echo "
    <td class='tableTopSides' rowspan='6'><div align='left'><a href='../CreatedReceivingReport.php?username=$username&sino=$siNo&page=0' target='_blank' class='style8'><span class='style4'>&nbsp;$invoiceNo-$supplierName<br />&nbsp;</span></a><span class='style5'>$recievedDatefmt<br />&nbsp;Check #: $vcheckedNo - $vdatefmt</span></div></td>
";
}
else if($vatable=='no'){
echo "
    <td class='tableTopSides' rowspan='5'><div align='left'><a href='../CreatedReceivingReport.php?username=$username&sino=$siNo&page=0' target='_blank' class='style8'><span class='style4'>&nbsp;$invoiceNo-$supplierName<br />&nbsp;</span></a><span class='style5'>$recievedDatefmt<br />&nbsp;Check #: $vcheckedNo - $vdatefmt</span></div></td>
";
}
}
else{
$totamountwovat+=$amountwovat;
$totamountvat+=$amountvat;
$finaltotamount+=$totamount;

echo "
    <td class='tableTopSides' rowspan='3'><div align='left'><a href='../CreatedReceivingReport.php?username=$username&sino=$siNo&page=0' target='_blank' class='style8'><span class='style4'>&nbsp;$invoiceNo-$supplierName<br />&nbsp;</span></a><span class='style5'>$recievedDatefmt</span></div></td>
";
}

echo "
    <td class='tableTopSides'><div align='left' class='style5'>&nbsp;Purchases On Acct.</div></td>
    <td class='tableTopSides'><div align='left' class='style5'></div></td>
    <td class='tableTopSides'><div align='right' class='style5'>$amountwovatfmt&nbsp;</div></td>
    <td class='tableTopSides'><div align='right' class='style5'></div></td>
  </tr>
  <tr>
    <td class='tableSides'><div align='left' class='style6'>&nbsp;Input VAT</div></td>
    <td class='tableSides'><div align='left' class='style6'></div></td>
    <td class='tableSides'><div align='right' class='style6'>$amountvatfmt&nbsp;</div></td>
    <td class='tableSides'><div align='right' class='style6'></div></td>
  </tr>
  <tr>
    <td class='tableTopSides'><div align='left' class='style7'></div></td>
    <td class='tableTopSides'><div align='left' class='style7'>&nbsp;Accounts Payable</div></td>
    <td class='tableTopSides'><div align='right' class='style7'></div></td>
    <td class='tableTopSides'><div align='right' class='style7'>$totamountfmt&nbsp;</div></td>
  </tr>
";

if($dcount[$num]!=0){
echo "
  <tr>
    <td class='tableTopSides'><div align='left' class='style5'>&nbsp;Accounts Payable</div></td>
    <td class='tableTopSides'><div align='left' class='style5'></div></td>
    <td class='tableTopSides'><div align='right' class='style5'>$totalpayfmt&nbsp;</div></td>
    <td class='tableTopSides'><div align='right' class='style5'></div></td>
  </tr>
";

if($vatable=='yes'){
echo "
  <tr>
    <td class='tableTopSides'><div align='left' class='style7'></div></td>
    <td class='tableTopSides'><div align='left' class='style7'>&nbsp;Cash In Bank-$vbank</div></td>
    <td class='tableTopSides'><div align='right' class='style7'></div></td>
    <td class='tableTopSides'><div align='right' class='style7'>$payamountfmt&nbsp;</div></td>
  </tr>
  <tr>
    <td class='tableSides'><div align='left' class='style7'></div></td>
    <td class='tableSides'><div align='left' class='style7'>&nbsp;Expanded Tax</div></td>
    <td class='tableSides'><div align='right' class='style7'></div></td>
    <td class='tableSides'><div align='right' class='style7'>$vwtaxfmt&nbsp;</div></td>
  </tr>
";
}
else if($vatable=='no'){
echo "
  <tr>
    <td class='tableTopSides'><div align='left' class='style7'></div></td>
    <td class='tableTopSides'><div align='left' class='style7'>&nbsp;Cash In Bank-$vbank</div></td>
    <td class='tableTopSides'><div align='right' class='style7'></div></td>
    <td class='tableTopSides'><div align='right' class='style7'>$totalpayfmt&nbsp;</div></td>
  </tr>
";
}


}
}

$totaldebit=$totamountwovat+$totamountvat;
$totaldebitfmt=number_format($totaldebit,2,'.',',');
$finaltotamountfmt=number_format($finaltotamount,2,'.',',');

echo "
  <tr>
    <td class='tableTopBottomSides' height='30' colspan='3'><div align='right' class='style3'>Total&nbsp;</div></td>
    <td class='tableTopBottomSides'><div align='right' class='style5'>$totaldebitfmt&nbsp;</div></td>
    <td class='tableTopBottomSides'><div align='right' class='style7'>$finaltotamountfmt&nbsp;</div></td>
  </tr>
</table>
</div>
";
?>
</body>
</html>

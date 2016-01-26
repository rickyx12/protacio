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
.style7 {font-family: Arial;font-size: 11px;color: #000000;font-weight: bold;}
.style8 {font-family: Arial;font-size: 12px;color: #FFFFFF;font-weight: bold;}
.style9 {font-family: Arial;font-size: 14px;color: #FFFFFF;}
.tableBottom {border-bottom: 2px solid #000000;}
.tableTop {border-top: 2px solid #000000;}
.tableTopBottom {border-top: 1px solid #000000;border-bottom: 1px solid #000000;}
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
.tableSidesLeft {border-left: 1px solid #000000;}
.tableSidesRight {border-right: 1px solid #000000;}
.tableTopLeft {border-top: 2px solid #000000;border-left: 1px solid #000000;}
.tableTopRight {border-top: 2px solid #000000;border-right: 1px solid #000000;}
.tableTopBottom1Left {border-top: 2px solid #000000;border-bottom: 1px solid #000000;border-left: 1px solid #000000;}
.tableTopBottom1Right {border-top: 2px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;}
.tableTopBottom1 {border-top: 2px solid #000000;border-bottom: 1px solid #000000;}
.tableTopRightLeft {border-right: 1px solid #000000;border-left: 1px solid #000000;border-top: 1px solid #000000;}
.tableTopSidesLeft {border-left: 1px solid #000000;border-top: 1px solid #000000;}
.tableTopSidesRight {border-right: 1px solid #000000;border-top: 1px solid #000000;}
.tableTop1 {border-top: 1px solid #000000;}
.tableTopBottomRightLeft {border-right: 1px solid #000000;border-left: 1px solid #000000;border-top: 2px solid #000000;border-bottom: 2px solid #000000;}
.tableTopBottomSidesLeft {border-left: 1px solid #000000;border-top: 2px solid #000000;border-bottom: 2px solid #000000;}
.tableTopBottomSidesRight {border-right: 1px solid #000000;border-top: 2px solid #000000;border-bottom: 2px solid #000000;}
.tableTopBottom2 {border-top: 2px solid #000000;border-bottom: 2px solid #000000;}

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
    <td height='30'><div align='left' class='style3'>Receiving Summary</div></td>
  </tr>
  <tr>
    <td height='30'><div align='left' class='style3'>From $fdatefmt To $tdatefmt</div></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpading='0'>
";

$a=0;
$b=0;
$c=0;
$d=0;
$e=0;
$asql=mysql_query("SELECT si.supplier, s.supplierName, s.vatable FROM salesInvoice si, supplier s WHERE si.supplier=s.supplierCode AND (si.recievedDate BETWEEN '$fdate' AND '$tdate') AND si.status NOT LIKE 'Deleted_%%%%' GROUP BY si.supplier ORDER BY s.supplierName");
while($afetch=mysql_fetch_array($asql)){
$supplier=$afetch['supplier'];
$supplierName=$afetch['supplierName'];
$vatable=$afetch['vatable'];

echo "
      <tr>
        <td width='15' class='tableTop'><div align='right'><img src='Bullet.png' height='10' width='auto' /></div></td>
        <td colspan='8' class='tableTop'><a href='Accounting/ViewPOPayables.php?username=$username&supplier=$supplier' target='_blank' class='style8'><div align='left' class='style4'>$supplierName</div></a></td>
      </tr>
      <tr>
        <td width='15' class='tableTopBottom1'></td>
        <td width='15' class='tableTopBottom1'><div align='right'></div></td>
        <td width='auto' class='tableTopBottom1'><div align='left' class='style7'>Invoice No.</div></td>
        <td width='auto' class='tableTopBottom1Right'><div align='center' class='style7'>Date</div></td>
        <td width='auto' class='tableTopBottom1Left'><div align='right' class='style7'>Amount&nbsp;</div></td>
        <td width='auto' class='tableTopBottom1'><div align='right' class='style7'>VAT&nbsp;</div></td>
        <td width='auto' class='tableTopBottom1Right'><div align='right' class='style7'>Total&nbsp;</div></td>
        <td width='auto' class='tableTopBottom1Left'><div align='right' class='style7'>Paid Amount&nbsp;</div></td>
        <td width='auto' class='tableTopBottom1'><div align='right' class='style7'>Expanded Tax&nbsp;</div></td>
      </tr>
";

$totalamount=0;
$totalvat=0;
$finaltotal=0;
$totalpaidamount=0;
$totalwtax=0;

$bsql=mysql_query("SELECT siNo, invoiceNo, recievedDate FROM salesInvoice WHERE supplier='$supplier' AND (recievedDate BETWEEN '$fdate' AND '$tdate') AND status NOT LIKE 'Deleted_%%%%' ORDER BY recievedDate");
while($bfetch=mysql_fetch_array($bsql)){
$siNo=$bfetch['siNo'];
$invoiceNo=$bfetch['invoiceNo'];
$recievedDate=$bfetch['recievedDate'];

$recievedDatestr=strtotime($recievedDate);
$recievedDatefmt=date("M d, Y",$recievedDatestr);

$csql=mysql_query("SELECT SUM(unitPrice*quantity) AS total FROM salesInvoiceItems WHERE siNo='$siNo' AND status NOT LIKE 'Deleted_%%%%'");
while($cfetch=mysql_fetch_array($csql)){$total=$cfetch['total'];}

$totalfmt=number_format($total,2,'.',',');

$amount=$total/1.12;
$amountfmt=number_format($amount,2,'.',',');

$vat=$total-($total/1.12);
$vatfmt=number_format($vat,2,'.',',');

$dsql=mysql_query("SELECT amount, vat, wtax FROM vouchers WHERE payee LIKE '%$supplierName%' AND invoiceNo='$invoiceNo'");
$dcount=mysql_num_rows($dsql);
while($dfetch=mysql_fetch_array($dsql)){$damount=$dfetch['amount'];$vat=$dfetch['vat'];$wtax=$dfetch['wtax'];}

if($dcount==0){
$paidamount=0;
$paidamountfmt=number_format($paidamount,2,'.',',');
$wtax=0;
$wtaxfmt=number_format($wtax,2,'.',',');
}
else{
if($vatable=='yes'){
$paidamount=$damount+$vat;
$paidamountfmt=number_format($paidamount,2,'.',',');

$wtaxfmt=number_format($wtax,2,'.',',');
}
else if($vatable=='no'){
$paidamount=$damount+$vat+$wtax;
$paidamountfmt=number_format($paidamount,2,'.',',');
$wtax=0;
$wtaxfmt=number_format($wtax,2,'.',',');
}
}

echo "
      <tr>
        <td width='15'></td>
        <td width='15'><div align='right'><img src='Bullet-2.png' height='8' width='auto' /></div></td>
        <td width='auto'><a href='CreatedReceivingReport.php?username=$username&sino=$siNo&page=0' target='_blank' class='style9'><div align='left' class='style5'>$invoiceNo</div></a></td>
        <td width='auto' class='tableSidesRight'><div align='center' class='style5'>$recievedDatefmt</div></td>
        <td width='auto' class='tableSidesLeft'><div align='right' class='style5'>$amountfmt&nbsp;</div></td>
        <td width='auto'><div align='right' class='style5'>&nbsp;$vatfmt</div></td>
        <td width='auto' class='tableSidesRight'><div align='right' class='style5'>$totalfmt&nbsp;</div></td>
        <td width='auto' class='tableSidesLeft'><div align='right' class='style5'>$paidamountfmt&nbsp;</div></td>
        <td width='auto'><div align='right' class='style5'>$wtaxfmt&nbsp;</div></td>
      </tr>
";

$totalamount+=$amount;
$totalvat+=$vat;
$finaltotal+=$total;
$totalpaidamount+=$paidamount;
$totalwtax+=$wtax;


}

$totalamountfmt=number_format($totalamount,2,'.',',');
$totalvatfmt=number_format($totalvat,2,'.',',');
$finaltotalfmt=number_format($finaltotal,2,'.',',');
$totalpaidamountfmt=number_format($totalpaidamount,2,'.',',');
$totalwtaxfmt=number_format($totalwtax,2,'.',',');

echo "
      <tr>
        <td width='auto' class='tableTopSidesRight' colspan='4'><div align='right' class='style4'>Sub Total&nbsp;</div></td>
        <td width='auto' class='tableTopSidesLeft'><div align='right' class='style4'>$totalamountfmt&nbsp;</div></td>
        <td width='auto' class='tableTop1'><div align='right' class='style4'>&nbsp;$totalvatfmt</div></td>
        <td width='auto' class='tableTopSidesRight'><div align='right' class='style4'>$finaltotalfmt&nbsp;</div></td>
        <td width='auto' class='tableTopSidesLeft'><div align='right' class='style4'>$totalpaidamountfmt&nbsp;</div></td>
        <td width='auto' class='tableTop1'><div align='right' class='style4'>$totalwtaxfmt&nbsp;</div></td>
      </tr>
";

$a+=$totalamount;
$b+=$totalvat;
$c+=$finaltotal;
$d+=$totalpaidamount;
$e+=$totalwtax;

}

$afmt=number_format($a,2,'.',',');
$bfmt=number_format($b,2,'.',',');
$cfmt=number_format($c,2,'.',',');
$dfmt=number_format($d,2,'.',',');
$efmt=number_format($e,2,'.',',');

echo "
      <tr>
        <td width='auto' class='tableTopBottomSidesRight' colspan='4' height='30'><div align='right' class='style4'>Overall Total&nbsp;</div></td>
        <td width='auto' class='tableTopBottomSidesLeft'><div align='right' class='style3'>$afmt&nbsp;</div></td>
        <td width='auto' class='tableTopBottom2'><div align='right' class='style3'>&nbsp;$bfmt</div></td>
        <td width='auto' class='tableTopBottomSidesRight'><div align='right' class='style3'>$cfmt&nbsp;</div></td>
        <td width='auto' class='tableTopBottomSidesLeft'><div align='right' class='style3'>$dfmt&nbsp;</div></td>
        <td width='auto' class='tableTopBottom2'><div align='right' class='style3'>$efmt&nbsp;</div></td>
      </tr>
    </table></td>
  </tr>
</table>
</div>
";
?>
</body>
</html>

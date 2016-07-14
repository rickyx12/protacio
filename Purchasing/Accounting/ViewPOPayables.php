<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Create Purchase Report</title>
<style type="text/css">
<!--
.style1 {font-family: Arial;font-size: 16px;color: #000000;font-weight: bold;}
.style2 {font-family: "Times New Roman";font-size: 16px;color: #FF0000;font-weight: bold;}
.style3 {font-family: Arial;font-size: 14px;color: #000000;font-weight: bold;}
.style4 {font-family: Arial;font-size: 12px;color: #FFFFFF;font-weight: bold;}
.style5 {font-family: Arial;font-size: 12px;color: #000000;font-weight: bold;}
.style6 {font-family: Arial;font-size: 14px;color: #FF0000;font-weight: bold;}
.textfield1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;}
.button2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #0066FF;border: 1px solid #000000;}
-->
</style>
<script type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_changeProp(objName,x,theProp,theValue) { //v6.0
  var obj = MM_findObj(objName);
  if (obj && (theProp.indexOf("style.")==-1 || obj.style)){
    if (theValue == true || theValue == false)
      eval("obj."+theProp+"="+theValue);
    else eval("obj."+theProp+"='"+theValue+"'");
  }
}

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</head>

<body>
<?php
include("../../myDatabase.php");
$cuz = new database();

($GLOBALS["___mysqli_ston"] = mysqli_connect($cuz->myHost(), $cuz->getUser(), $cuz->getPass()));
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $cuz->getDB()));

$username=$_GET['username'];
$supplier=$_GET['supplier'];

$day=date("d");
$month=date("m");
$year=date("Y");

$asql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT supplierName, contactNo, Address FROM supplier WHERE supplierCode='$supplier'");
while($afetch=mysqli_fetch_array($asql)){$supplierName=$afetch['supplierName'];$Address=$afetch['Address'];$contactNo=$afetch['contactNo'];}


if($supplier=='-Select Supplier-'){
echo "
<br />

<div align='left' class='style6'>Please Select Supplier</div>
";
echo "<META HTTP-EQUIV='Refresh'CONTENT='2;URL=ViewPOPayablesSelect.php?username=$username'>";
}
else{
echo "
<br />

<div align='left'>
<table width='700' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td>
      <table width='100%' border='0' bordercolor='#000000' cellspacing='0' cellpadding='0'>
        <tr>
          <td width='100%'><div alogn='left' class='style1'>$supplierName</div></td>
        </tr>
        <tr>
          <td><div alogn='left' class='style3'>Address: $Address</div></td>
        </tr>
        <tr>
          <td><div alogn='left' class='style3'>Contact No.: $contactNo</div></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td height='20'></td>
  </tr>
  <form name='SelectTransaction' method='get' action='/COCONUT/accounting/voucher/addVoucher_purchasing.php'>
  <tr>
    <td height='25'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='70%'><div align='left' class='style3'>PO with Balance</div></td>
        <td width='30%'><div align='right' class='style3'><input type='submit' name='CreateVoucher' class='button2' value='Create Voucher &gt;&gt;' /></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan='2' bgcolor='#000000'><table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
      <tr>
        <td width='20%' bgcolor='#0066FF' class='style4'><div align='center'>Invoice No</div></td>
        <td width='30%' bgcolor='#0066FF' class='style4'><div align='center'>Recieved Date</div></td>
        <td width='20%' bgcolor='#0066FF' class='style4'><div align='center'>Terms</div></td>
        <td width='20%' bgcolor='#0066FF' class='style4'><div align='center'>Amount</div></td>
        <td width='10%' bgcolor='#0066FF' class='style4'><div align='center'>Select</div></td>
      </tr>
";

$x=0;
$bsql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT siNo, invoiceNo, terms, recievedDate FROM salesInvoice WHERE supplier='$supplier' AND status='Active' ORDER BY recievedDate");
while($bfetch=mysqli_fetch_array($bsql)){
$siNo=$bfetch['siNo'];
$invoiceNo=$bfetch['invoiceNo'];
$terms=$bfetch['terms'];
$receivedDate=$bfetch['recievedDate'];

$receivedDatestr=strtotime($receivedDate);
$receivedDatefmt=date("M d, Y",$receivedDatestr);

$csql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT SUM(unitPrice*(quantity)) AS totalAmount FROM salesInvoiceItems WHERE siNo='$siNo' AND status='Active'");
while($cfetch=mysqli_fetch_array($csql)){$totalAmount=$cfetch['totalAmount'];}

$totalAmountfmt=number_format($totalAmount,2,'.',',');

$dsql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT SUM(amount+vat+wtax) AS totamount FROM vouchers WHERE invoiceNo='$invoiceNo'");
while($dfetch=mysqli_fetch_array($dsql)){$amount=$dfetch['totamount'];}

$balance=$totalAmount-$amount;

if($balance>0.001){
$x++;
echo "
      <tr bgcolor='#FFFFFF'>
        <td class='style5'><a href='../CreatedReceivingReport.php?username=$username&sino=$siNo&page=0' target='_blank' class='style5'><div align='center'>$invoiceNo</div></a></td>
        <td class='style5'><div align='left'>&nbsp;$receivedDatefmt</div></td>
        <td class='style5'><div align='center'>$terms</div></td>
        <td class='style5'><div align='right'>$totalAmountfmt&nbsp;</div></td>
        <td class='style5'><div align='center'><input type='hidden' name='siNo$x' value='' /><input type='checkbox' name='siNo[]' class='textfield1' value='".$siNo."-".$totalAmount."-".$supplier."-".$username."' /></div></td>
      </tr>
";
}
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
  <input type='hidden' name='username' value='$username' />
  <input type='hidden' name='supplier' value='$supplier' />
  <input type='hidden' name='x' value='$x' />
  </form>
</table>
</div>
";
}

?>
</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Create Purchase Report</title>
<style type="text/css">
<!--
.style1 {font-family: Arial; font-size: 14px; color: #FFFFFF; font-weight: bold; }
.style2 {font-family: Arial; font-size: 12px; color: #FFFFFF; font-weight: bold; }
.style3 {font-family: Arial; font-size: 12px; color: #000000; font-weight: bold; }
.style4 {font-family: Arial; font-size: 14px; color: #000000; font-weight: bold; }
.textfield1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #FF7700;border: 1px solid #000000;height: 25px; width: 200px;}
.textfield2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #FF7700;border: 1px solid #000000;height: 25px;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;}
tr:hover { background-color:yellow;color:black;}
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
include("../myDatabase.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$username=$_GET['username'];

$fmonth=$_GET['fmonth'];
$fday=$_GET['fday'];
$fyear=$_GET['fyear'];

$fdate=$fyear.$fmonth.$fday;
$fdatestr=strtotime($fdate);
$fdatefmt=date("M d, Y",$fdatestr);

$tmonth=$_GET['tmonth'];
$tday=$_GET['tday'];
$tyear=$_GET['tyear'];

$tdate=$tyear.$tmonth.$tday;
$tdatestr=strtotime($tdate);
$tdatefmt=date("M d, Y",$tdatestr);

echo "
<br />
<div align='left'>
<span class='style4'>Purchases Order From $fdatefmt To $tdatefmt.</span>
  <table width='550' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
    <tr>
      <td width='250' height='20' bgcolor='#0066FF'><div align='center' class='style2'>Supplier</div></td>
      <td width='120' height='20' bgcolor='#0066FF'><div align='center' class='style2'>Date</div></td>
      <td width='100' height='20' bgcolor='#0066FF'><div align='center' class='style2'>Amount</div></td>
      <td width='80' height='20' bgcolor='#0066FF'><div align='center' class='style2'>View</div></td>
    </tr>
";

$asql=mysql_query("SELECT poNo, supplier, transactionDate FROM purchaseOrderForm WHERE transactionDate BETWEEN '$fdate' AND '$tdate' ORDER BY transactionDate");
while($afetch=mysql_fetch_array($asql)){
$poNo=$afetch['poNo'];
$supplier=$afetch['supplier'];
$transactionDate=$afetch['transactionDate'];

$transactionDatestr=strtotime($transactionDate);
$transactionDatefmt=date("M d, Y",$transactionDatestr);

$truesupplier=preg_split("/-/", $supplier);

$csql=mysql_query("SELECT SUM(quantity*unitPrice) AS total FROM purchaseOrderItems WHERE poNo='$poNo' ORDER BY poNo");
while($cfetch=mysql_fetch_array($csql)){$total=$cfetch['total'];}

$totalfmt=number_format($total,2,'.',',');

echo "
    <tr>
      <td><div align='left' class='style3'>&nbsp;".$truesupplier[1]."</div></td>
      <td><div align='center' class='style3'>$transactionDatefmt</div></td>
      <td><div align='right' class='style3'>$totalfmt&nbsp;</div></td>
      <form id='View' name='view' method='get' action='CreatedPurchaseOrder.php'>
      <input type='hidden' name='username' value='$username' />
      <input type='hidden' name='poNo' value='$poNo' />
      <td><div align='center'>
        <input type='submit' name='View' class='button1' value='View' />
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
    </tr>
  </table>
</div>
";

?>
</body>
</html>

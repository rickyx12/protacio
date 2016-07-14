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
.button2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FF0000;background-color: #FFFFFF;border: 1px solid #FF0000;}
.button3 {font-family: Arial;font-size: 12px;font-weight: bold;color: #D3D3D3;background-color: #FFFFFF;border: 1px solid #D3D3D3;}
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

($GLOBALS["___mysqli_ston"] = mysqli_connect($cuz->myHost(), $cuz->getUser(), $cuz->getPass()));
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $cuz->getDB()));

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
<span class='style4'>Recieved Invoice From $fdatefmt To $tdatefmt.</span>
  <table width='650' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
    <tr>
      <td width='50' height='20' bgcolor='#0066FF'><div align='center' class='style2'>Invoice No.</div></td>
      <td width='250' height='20' bgcolor='#0066FF'><div align='center' class='style2'>Supplier</div></td>
      <td width='120' height='20' bgcolor='#0066FF'><div align='center' class='style2'>Date</div></td>
      <td width='100' height='20' bgcolor='#0066FF'><div align='center' class='style2'>Amount</div></td>
      <td width='50' height='20' bgcolor='#0066FF'><div align='center' class='style2'>Edit</div></td>
      <td width='50' height='20' bgcolor='#0066FF'><div align='center' class='style2'>Delete</div></td>
      <td width='80' height='20' bgcolor='#0066FF'><div align='center' class='style2'>View</div></td>
    </tr>
";

$asql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT siNo, invoiceNo, supplier, transactionDate FROM salesInvoice WHERE (recievedDate BETWEEN '$fdate' AND '$tdate') AND status='Active'  ORDER BY transactionDate");
while($afetch=mysqli_fetch_array($asql)){
$siNo=$afetch['siNo'];
$invoiceNo=$afetch['invoiceNo'];
$supplier=$afetch['supplier'];
$transactionDate=$afetch['transactionDate'];

$transactionDatestr=strtotime($transactionDate);
$transactionDatefmt=date("M d, Y",$transactionDatestr);

$bsql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT supplierName FROM supplier WHERE supplierCode='$supplier'");
while($bfetch=mysqli_fetch_array($bsql)){$supplierName=$bfetch['supplierName'];}

$csql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT SUM(quantity*unitPrice) AS total FROM salesInvoiceItems WHERE siNo='$siNo' ORDER BY refNo");
while($cfetch=mysqli_fetch_array($csql)){$total=$cfetch['total'];}

$totalfmt=number_format($total,2,'.',',');

echo "
    <tr>
      <td><div align='left' class='style3'>&nbsp;$invoiceNo</div></td>
      <td><div align='left' class='style3'>&nbsp;$supplierName</div></td>
      <td><div align='center' class='style3'>$transactionDatefmt</div></td>
      <td><div align='right' class='style3'>$totalfmt&nbsp;</div></td>
      <form id='View' name='view' method='get' action='EditReceivingReport.php'>
      <input type='hidden' name='username' value='$username' />
      <input type='hidden' name='sino' value='$siNo' />
      <input type='hidden' name='invoiceNo' value='$invoiceNo' />
      <input type='hidden' name='supplierName' value='$supplierName' />
      <input type='hidden' name='fyear' value='$fyear' />
      <input type='hidden' name='fmonth' value='$fmonth' />
      <input type='hidden' name='fday' value='$fday' />
      <input type='hidden' name='tyear' value='$tyear' />
      <input type='hidden' name='tmonth' value='$tmonth' />
      <input type='hidden' name='tday' value='$tday' />
      <input type='hidden' name='page' value='0' />
      <td><div align='center'>
        <input type='submit' name='View' class='button1' value=' E ' />
      </div></td>
      </form>
";

$csql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM salesInvoiceItems WHERE siNo='$siNo' AND status='Active'");
$ccount=mysqli_num_rows($csql);
if($ccount=='0'){
echo "
      <form id='View' name='view' method='get' action='DeleteReceivingReport.php'>
      <input type='hidden' name='username' value='$username' />
      <input type='hidden' name='sino' value='$siNo' />
      <input type='hidden' name='invoiceNo' value='$invoiceNo' />
      <input type='hidden' name='supplierName' value='$supplierName' />
      <input type='hidden' name='fyear' value='$fyear' />
      <input type='hidden' name='fmonth' value='$fmonth' />
      <input type='hidden' name='fday' value='$fday' />
      <input type='hidden' name='tyear' value='$tyear' />
      <input type='hidden' name='tmonth' value='$tmonth' />
      <input type='hidden' name='tday' value='$tday' />
      <input type='hidden' name='page' value='0' />
      <td><div align='center'>
        <input type='submit' name='View' class='button2' value=' X ' />
      </div></td>
      </form>
";
}
else{
echo "
      <td><div align='center'>
        <input type='submit' name='View' class='button3' value=' X ' />
      </div></td>
";
}

echo "
      <form id='View' name='view' method='get' action='CreatedReceivingReport.php'>
      <input type='hidden' name='username' value='$username' />
      <input type='hidden' name='sino' value='$siNo' />
      <input type='hidden' name='page' value='0' />
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

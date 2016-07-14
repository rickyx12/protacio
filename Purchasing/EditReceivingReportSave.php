<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Create Purchase Report</title>
<style type="text/css">
<!--
.style1 {font-family: Arial; font-size: 12; color: #FFFFFF; font-weight: bold; }
.style2 {font-family: Arial; font-size: 14px; color: #000000; font-weight: bold; }
.style3 {font-family: Arial; font-size: 11px; color: #FF0000; font-weight: bold; }
.style4 {font-family: Arial; font-size: 14px; color: #FF0000; font-weight: bold; }

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
$sino=$_GET['sino'];
$page=$_GET['page'];
$invoiceNo=$_GET['invoiceNo'];
$supplier=$_GET['supplier'];
$terms=$_GET['terms'];
$tdmonth=$_GET['rdmonth'];
$tdday=$_GET['rdday'];
$tdyear=$_GET['rdyear'];
$rdmonth=$_GET['rdmonth'];
$rdday=$_GET['rdday'];
$rdyear=$_GET['rdyear'];

$fmonth=$_GET['fmonth'];
$fday=$_GET['fday'];
$fyear=$_GET['fyear'];

$tmonth=$_GET['tmonth'];
$tday=$_GET['tday'];
$tyear=$_GET['tyear'];

$insertdate=date("ymdHi");

$tddate=$tdyear.$tdmonth.$tdday;
$rddate=$rdyear.$rdmonth.$rdday;

$asql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM salesInvoice WHERE siNo='$sino' AND status='Active'");
while($afetch=mysqli_fetch_array($asql)){$cinvoiceNo=$afetch['invoiceNo'];$csupplier=$afetch['supplier'];$cterms=$afetch['terms'];$ctransactionDate=$afetch['transactionDate'];$creceivedDate=$afetch['recievedDate'];}

if(($cinvoiceNo==$invoiceNo)&&($csupplier==$supplier)&&($cterms==$terms)&&($creceivedDate==$rddate)){
echo "
<br />
<div align='left' class='style2'>No changes were made.</div>
";
echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=EditReceivingReport.php?username=$username&sino=$sino&invoiceNo=$invoiceNo&supplier=$supplier&terms=$terms&rdday=$rdday&rdmonth=$rdmonth&rdyear=$rdyear&fyear=$fyear&fmonth=$fmonth&fday=$fday&tyear=$tyear&tmonth=$tmonth&tday=$tday&page=$page'>";
}
else{
if($invoiceNo==''){
echo "
<br />
<div align='left' class='style4'>Invoice Number must not be blank. Try Again!!!</div>
";
echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=EditReceivingReportTwo.php?username=$username&sino=$sino&invoiceNo=$invoiceNo&supplier=$supplier&terms=$terms&rdday=$rdday&rdmonth=$rdmonth&rdyear=$rdyear&fyear=$fyear&fmonth=$fmonth&fday=$fday&tyear=$tyear&tmonth=$tmonth&tday=$tday&page=$page'>";
}
else{
$xsql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT invoiceNo, supplier FROM salesInvoice WHERE siNo NOT LIKE '$sino' AND invoiceNo='$invoiceNo' AND supplier='$supplier'");
$xcount=mysqli_num_rows($xsql);
if($xcount!=0){
echo "
<br />
<div align='left' class='style4'>Duplicate Invoice Number. Try Again!!!</div>
";
echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=EditReceivingReport.php?username=$username&sino=$sino&invoiceNo=$invoiceNo&supplier=$supplier&terms=$terms&rdday=$rdday&rdmonth=$rdmonth&rdyear=$rdyear&fyear=$fyear&fmonth=$fmonth&fday=$fday&tyear=$tyear&tmonth=$tmonth&tday=$tday&page=$page'>";
}
else{
echo "
<br />
<div align='left' class='style2'>Loading...</div>
";

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE salesInvoice SET invoiceNo='$invoiceNo', supplier='$supplier', terms='$terms', transactionDate='$rddate', recieveddate='$rddate' WHERE siNo='$sino'");

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=ViewPurchases.php?username=$username&fmonth=$fmonth&fday=$fday&fyear=$fyear&tmonth=$tmonth&tday=$tday&tyear=$tyear'>";
}
}
}
?>
</body>
</html>

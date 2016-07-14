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

$invoiceNo=$_GET['invoiceNo'];
$supplier=$_GET['supplier'];
$terms=$_GET['terms'];
$tdmonth=$_GET['rdmonth'];
$tdday=$_GET['rdday'];
$tdyear=$_GET['rdyear'];
$rdmonth=$_GET['rdmonth'];
$rdday=$_GET['rdday'];
$rdyear=$_GET['rdyear'];
$username=$_GET['username'];

$insertdate=date("YmdHi");

$tddate=$tdyear.$tdmonth.$tdday;
$rddate=$rdyear.$rdmonth.$rdday;


if($invoiceNo==''){
echo "
<br />
<div align='left' class='style4'>Invoice Number must not be blank. Try Again!!!</div>
";
echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=CreateReceivingReportError.php?username=$username&invoiceNo=$invoiceNo&supplier=$supplier&terms=$terms&tdday=$tdday&tdmonth=$tdmonth&tdyear=$tdyear&rdday=$rdday&rdmonth=$rdmonth&rdyear=$rdyear'>";
}
else{
if($supplier=='-Select Supplier-'){
echo "
<br />
<div align='left' class='style4'>Please select a supplier. Try Again!!!</div>
";
echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=CreateReceivingReportError.php?username=$username&invoiceNo=$invoiceNo&supplier=$supplier&terms=$terms&tdday=$tdday&tdmonth=$tdmonth&tdyear=$tdyear&rdday=$rdday&rdmonth=$rdmonth&rdyear=$rdyear'>";
}
else{
if($terms=='-Select Terms-'){
echo "
<br />
<div align='left' class='style4'>Please select a terms. Try Again!!!</div>

";
echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=CreateReceivingReportError.php?username=$username&invoiceNo=$invoiceNo&supplier=$supplier&terms=$terms&tdday=$tdday&tdmonth=$tdmonth&tdyear=$tdyear&rdday=$rdday&rdmonth=$rdmonth&rdyear=$rdyear'>";
}
else{

$xsql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT invoiceNo, supplier FROM salesInvoice WHERE invoiceNo='$invoiceNo' AND supplier='$supplier' AND status NOT LIKE 'Deleted%%'");
$xcount=mysqli_num_rows($xsql);
if($xcount!=0){
echo "
<br />
<div align='left' class='style4'>Duplicate Invoice Number. Try Again!!!</div>
";
echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=CreateReceivingReportError.php?username=$username&invoiceNo=$invoiceNo&supplier=$supplier&terms=$terms&tdday=$tdday&tdmonth=$tdmonth&tdyear=$tdyear&rdday=$rdday&rdmonth=$rdmonth&rdyear=$rdyear'>";
}
else{
if($rddate<$tddate){
echo "
<br />
<div align='left' class='style4'>Invalid Recieved Date. Try Again!!!</div>
";
echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=CreateReceivingReportError.php?username=$username&invoiceNo=$invoiceNo&supplier=$supplier&terms=$terms&tdday=$tdday&tdmonth=$tdmonth&tdyear=$tdyear&rdday=$rdday&rdmonth=$rdmonth&rdyear=$rdyear'>";
}
else{
echo "
<br />
<div align='left' class='style2'>Loading...</div>
";

$pdate=date("Ymd");

$cdatesql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT counterdate FROM counters");
while($cdatefetch=mysqli_fetch_array($cdatesql)){$cdate=$cdatefetch['counterdate'];}

if($cdate!=$pdate){mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE counters SET counterdate='$pdate', counter01='0'");}

$c01sql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT counter01 FROM counters");
while($c01fetch=mysqli_fetch_array($c01sql)){$c01=$c01fetch['counter01'];}

if($c01<10){$sino=date("Ymd")."000".$c01;}
else if(($c01<100)&&($c01>9)){$sino=date("Ymd")."00".$c01;}
else if(($c01<1000)&&($c01>99)){$sino=date("Ymd")."0".$c01;}
else{$sino=date("Ymd").$c01;}

$c01plus=$c01+1;

mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO salesInvoice VALUES('$sino', '$invoiceNo', '$supplier', '$terms', '$rddate', '$tddate', 'Active', '$username', '$insertdate')");

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE counters SET counter01='$c01plus'");
echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=CreatedReceivingReport.php?username=$username&sino=$sino&page=0'>";
}
}
}
}
}
?>
</body>
</html>

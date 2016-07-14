<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Create Purchase Report</title>
<style type="text/css">
<!--
.style1 {font-family: Arial; font-size: 14px; color: #000000; font-weight: bold; }
.style2 {font-family: Arial; font-size: 12px; color: #FFFFFF; font-weight: bold; }
.style3 {font-family: Arial; font-size: 11px; color: #FF0000; font-weight: bold; }
.style4 {font-family: Arial; font-size: 14px; color: #FF0000; font-weight: bold; }
.textfield1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;width: 200px;}
.textfield2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
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
//-->
</script>
</head>

<body onload="placeFocus()">
<?php
include("../myDatabase.php");
$cuz = new database();

($GLOBALS["___mysqli_ston"] = mysqli_connect($cuz->myHost(), $cuz->getUser(), $cuz->getPass()));
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $cuz->getDB()));

$username=$_GET['username'];
$sino=$_GET['sino'];
$invoiceNo=$_GET['invoiceNo'];
$supplierName=$_GET['supplierName'];
$page=$_GET['page'];

$fmonth=$_GET['fmonth'];
$fday=$_GET['fday'];
$fyear=$_GET['fyear'];

$tmonth=$_GET['tmonth'];
$tday=$_GET['tday'];
$tyear=$_GET['tyear'];


echo "
<br />
<div align='left' class='style1'>Removing...</div>
";

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE salesInvoice SET status='Deleted_$username' WHERE siNo='$sino'");

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=ViewPurchases.php?username=$username&fmonth=$fmonth&fday=$fday&fyear=$fyear&tmonth=$tmonth&tday=$tday&tyear=$tyear'>";
?>
</body>
</html>
